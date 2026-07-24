<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index($conversationId = null)
    {

        if ($conversationId) {
            try {
                $conversationId = decrypt($conversationId);
            } catch (\Throwable $th) {
                abort(404);
            }
        }

        $pageTitle = 'Messages';
        $user = auth()->user();
        $conversation = null;
        $messages =  null;
        $opponent = null;
        $limit = 10;

        $conversations = $this->searchUserConversations($user);
        if ($conversationId) {
            $limit -= 1;
            $conversationData = $this->getConversation($user, $conversationId);
            $conversation = $conversationData["conversation"];
            $opponent = $conversationData["opponent"];
            $messages = $conversation->messages->sort();
            $conversations = $conversations->where('id', '!=', $conversation->id);
        }

        $conversations = $conversations->latest()->limit($limit)->get();
        return view('Template::user.message.index', compact('pageTitle', 'conversations', 'user', 'conversationId', 'messages', 'opponent', 'conversation'));
    }

    public function messageStore(Request $request)
    {
        if (!$request->ajax()) {
            return false;
        }
        $general = gs();
        $user = auth()->user();
        $conversation = Conversation::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->with('receiver', 'sender')->findOrFail($request->conversation_id);

        if ($conversation->sender_id == $user->id) {
            $receiver = $conversation->receiver;
        } else {
            $receiver = $conversation->sender;
        }

        $messageValidation = 'required';
        $imageValidation = 'required';

        if ($request->message) {
            $imageValidation = 'nullable';
        }

        if ($request->image) {
            $messageValidation = 'nullable';
        }

        $rule = [
            'message' => $messageValidation . '|max:65000',
            'image' => [$imageValidation, 'image', 'max:100000', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];

        $validator = Validator::make($request->all(), $rule);

        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user = auth()->user();
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = $user->id;
        $message->receiver_id = $receiver->id;
        $message->message = $request->message;

        if ($request->hasFile('image') && $general->chat_attachment) {
            $file = $request->image;
            $path = getFilePath('message');
            try {
                $filename = fileUploader($file, $path);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
            $message->file = $filename;
        }

        $conversation->updated_at = Carbon::now();
        $conversation->save();
        $message->save();

        $user = $user;
        if ($conversation->sender_id != $user->id) {
            $opponent = $conversation->sender;
        } else {
            $opponent = $conversation->receiver;
        }
        $messages = Message::where('conversation_id', $conversation->id)->latest()->take(15)->get()->sort();

        $response = view('Template::user.message.get_message', compact('messages', 'user', 'opponent'))->render();

        $lastId = count($messages) > 0 ?  $messages->first()->id : 0;

        return response()->json(['success' => true, 'message' => 'Message sent successfully', 'response' => $response, 'lastId' => $lastId]);
    }


    public function memberSearch(Request $request)
    {
        $user = auth()->user();
        $conversation = null;
        $opponent = null;
        $limit = 10;
        $conversationId = $request->conversationId;

        $conversations = $this->searchUserConversations($user);

        if ($conversationId) {
            $conversation = (clone $conversations)->find($conversationId);
            if ($conversation) {
                $limit -= 1;
                $conversations = $conversations->where('id', '!=', $conversation->id);
                if ($conversation->sender_id != $user->id) {
                    $opponent = $conversation->sender;
                } else {
                    $opponent = $conversation->receiver;
                }
            }
        }

        $conversations = $conversations->latest()->limit($limit)->get();

        $html = view('Template::user.message.member_list', compact('user', 'conversations', 'conversationId', 'conversation', 'opponent'))->render();

        return response()->json(['html' => $html]);
    }

    public function appendMember(Request $request)
    {
        $user = auth()->user();
        $conversation = null;
        $conversationId = $request->conversationId ?? null;

        $conversationsData = $this->searchUserConversations($user);
        $conversations = (clone $conversationsData)->where('id', '<', $request->lastConversationId)->where('id', '!=', $conversationId);

        $conversationId = $request->conversationId;
        $lastId = count($conversations) ? $conversations->last()->id : 0;

        if ($conversationId) {
            $conversation = $conversationsData->find($conversationId);
            if ($conversation) {
                $conversations = $conversations->where('id', '!=', $conversation->id);
            }
        }

        $conversations = $conversations->latest()->take(10)->get();

        if (count($conversations)) {
            $html = view('Template::user.message.member_list', compact('user', 'conversations', 'conversationId'))->render();
        } else {
            $html = null;
        }

        return response()->json(['html' => $html, 'lastId' => $lastId]);
    }


    public function loadMessage(Request $request)
    {
        $user = auth()->user();
        $lastId = $request->lastId;
        $data = $this->getConversation($user, $request->conversationId, $lastId);
        $conversation = $data['conversation'];
        $messages = $conversation->messages->sort();
        $opponent = $data['opponent'];
        $html = view('Template::user.message.get_message', compact('user', 'messages', 'opponent'))->render();
        $lastId = count($messages) > 0 ?  $messages->first()->id : 0;
        $divId = count($messages) > 0 ?  $messages->last()->id : 0;

        return response()->json(['html' => $html, 'lastId' => $lastId, 'divId' => $divId]);
    }

    private function searchUserConversations($user)
    {
        $search = request()->search;
        if ($search) {
            $conversations = Conversation::where(function ($query) use ($search) {
                $query->whereHas('sender', function ($q) use ($search) {
                    $q->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%")
                        ->orWhere(DB::raw('concat(firstname, " ", lastname)'), 'like', "%$search%")
                        ->orWhere('username', 'like', "%$search%");
                })
                    ->orWhereHas('receiver', function ($q) use ($search) {
                        $q->where('firstname', 'like', "%$search%")
                            ->orWhere('lastname', 'like', "%$search%")
                            ->orWhere(DB::raw('concat(firstname, " ", lastname)'), 'like', "%$search%")
                            ->orWhere('username', 'like', "%$search%");
                    });
            })->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
            });
        } else {
            $conversations = Conversation::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
            });
        }

        $conversations = $conversations->with(['sender', 'receiver', 'messages' => function ($query) {
            $query->orderBy('id', 'desc')->take(1);
        }])->withCount(['messages' => function ($q) use ($user) {
            $q->where('read_status', Status::NO)->where('receiver_id', $user->id);
        }]);

        return $conversations;
    }

    private function getConversation($user, $conversationId, $lastId = 0)
    {
        $conversation = Conversation::where(function ($query) use ($user) {
            $query->orWhere('receiver_id', $user->id)->orWhere('sender_id', $user->id);
        })->with(['sender', 'receiver', 'messages' => function ($q) use ($lastId) {
            if ($lastId) {
                $q->where('id', '<', $lastId);
            }
            $q->latest()->take(15);
        }])->findOrFail($conversationId);

        $conversation->messages()->where('read_status', Status::NO)->where('receiver_id', $user->id)->update(['read_status' => Status::YES]);

        $response['conversation'] = $conversation;

        if ($conversation->sender_id != $user->id) {
            $opponent = $conversation->sender;
        } else {
            $opponent = $conversation->receiver;
        }
        $response['opponent'] = $opponent;

        return $response;
    }
}
