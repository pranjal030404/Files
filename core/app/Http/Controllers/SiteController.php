<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\Package;
use App\Models\Page;
use App\Models\PhysicalAttribute;
use App\Models\ReligionInfo;
use App\Models\CasteInfo;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class SiteController extends Controller
{
    public function index()
    {
         if (isset($_GET['reference'])) {
            $reference = $_GET['reference'];
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', activeTemplate())->where('slug', '/')->first();
        $seoContents = $sections->seo_content;
        $seoImage = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::home', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', activeTemplate())->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        $seoContents = $page->seo_content;
        $seoImage = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::pages', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        $user = auth()->user();
        $sections = Page::where('tempname', activeTemplate())->where('slug', 'contact')->first();
        $seoContents = $sections->seo_content;
        $seoImage = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;

        return view('Template::contact', compact('pageTitle', 'user', 'sections', 'seoContents', 'seoImage'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $request->session()->regenerateToken();

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug)
    {
        $policy = Frontend::where('slug', $slug)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        $seoContents = $policy->seo_content;
        $seoImage = @$seoContents->image ? frontendImage('policy_pages', $seoContents->image, getFileSize('seo'), true) : null;
        return view('Template::policy', compact('policy', 'pageTitle', 'seoContents', 'seoImage'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    /*
     * Built-in pages (blog, stories) always have their own route, so their `pages`
     * row only exists to hold the sections/SEO an admin attaches from the panel.
     * Register it on first visit instead of failing when it was never seeded.
     */
    protected function defaultPage($slug, $name)
    {
        $page = Page::where('tempname', activeTemplate())->where('slug', $slug)->first();
        if (!$page) {
            $page = new Page();
            $page->tempname = activeTemplate();
            $page->name = $name;
            $page->slug = $slug;
        }
        // Keep it default even when an admin added the row by hand, so it stays
        // out of the footer's dynamic page list and can't be deleted out from
        // under the route.
        if ($page->is_default != Status::YES) {
            $page->is_default = Status::YES;
            $page->save();
        }
        return $page;
    }

    public function blogs()
    {
        $pageTitle = 'Blog';
        $blogs = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'blog.element')->orderBy('id', 'desc')->paginate(getPaginate(12));
        $page = $this->defaultPage('blog', 'Blog');
        $sections = $page->secs;

        return view('Template::blog', compact('pageTitle', 'blogs', 'sections'));
    }

    public function blogDetails($slug)
    {
        $blog = Frontend::where('tempname', activeTemplateName())->where('slug', $slug)->where('data_keys', 'blog.element')->firstOrFail();
        $dataValues = $blog->data_values;
        $dataValues->total_view = (int) @$dataValues->total_view + 1;
        $blog->data_values = $dataValues;
        $blog->save();

        $pageTitle = $blog->data_values->title;

        $popularBlogs = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'blog.element')->where('slug', '!=', $slug)->orderBy('data_values->total_view', 'desc')->limit(5)->get();
        $latestBlogs = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'blog.element')->where('slug', '!=', $slug)->orderBy('id', 'desc')->limit(5)->get();
        $seoContents = $blog->seo_content;
        $seoImage = @$seoContents->image ? frontendImage('blog', $seoContents->image, getFileSize('seo'), true) : null;
        return view('Template::blog_details', compact('blog', 'pageTitle', 'popularBlogs', 'latestBlogs', 'seoContents', 'seoImage'));
    }

    public function cookieAccept()
    {
        Cookie::queue('gdpr_cookie', gs('site_name'), 43200);
    }

    public function cookiePolicy()
    {
        $cookieContent = Frontend::where('data_keys', 'cookie.data')->first();
        abort_if($cookieContent->data_values->status != Status::ENABLE, 404);
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys', 'cookie.data')->first();
        return view('Template::cookie', compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font/solaimanLipi_bold.ttf');
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        if (gs('maintenance_mode') == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view('Template::maintenance', compact('pageTitle', 'maintenance'));
    }

    public function packages()
    {
        $pageTitle = 'Packages';
        $page = Page::where('tempname', activeTemplate())->where('slug', 'packages')->firstOrFail();
        $packages = Package::active()->orderBy('price', 'ASC')->get();
        $sections = $page->secs;

        return view('Template::packages', compact('pageTitle', 'sections', 'packages'));
    }

    public function stories()
    {
        $pageTitle = 'Stories';
        $stories = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'stories.element')->orderBy('id', 'desc')->paginate(getPaginate(28));
        $page = $this->defaultPage('stories', 'Stories');
        $sections = $page->secs;

        return view('Template::stories', compact('pageTitle', 'stories', 'sections'));
    }


    public function storyDetails($slug)
    {
        $story = Frontend::where('tempname', activeTemplateName())->where('slug', $slug)->where('data_keys', 'stories.element')->firstOrFail();
        $dataValues = $story->data_values;
        $dataValues->total_view = (int) @$dataValues->total_view + 1;
        $story->data_values = $dataValues;
        $story->save();

        $pageTitle = $story->data_values->title;

        $popularStories = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'stories.element')->where('slug', '!=', $slug)->orderBy('data_values->total_view', 'desc')->limit(5)->get();
        $latestStories = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'stories.element')->where('slug', '!=', $slug)->orderBy('id', 'desc')->limit(5)->get();
        return view('Template::story_details', compact('story', 'pageTitle', 'popularStories', 'latestStories'));
    }

    public function members()
    {
        $userData = $this->userData();
        $members = $userData['members'];
        $user    = auth()->user();

        if (request()->ajax()) {
            return response()->json([
                'html' => view('Template::partials.members', compact('members', 'user'))->render()
            ]);
        }

        $pageTitle       = 'Searched Members';
        $maritalStatuses = MaritalStatus::all();
        $religions       = ReligionInfo::get();
        $castes          = CasteInfo::get();
        $countryData     = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countries       = array_column($countryData, 'country');

        $height['max'] = $userData['maxHeight'];
        $height['min'] = $userData['minHeight'];

        if ($height['min'] == $height['max']) {
            $height['min'] = 0;
        }
        return view('Template::user.members.list', compact('pageTitle', 'user', 'members', 'maritalStatuses', 'religions', 'castes', 'countries', 'height'));
    }

    protected function userData()
    {
        $request = request();
        $userId    = auth()->id();
        $query = User::active()->profileCompleted();
        $maxHeight = round(PhysicalAttribute::max('height')) ?? 0;
        $minHeight = round(PhysicalAttribute::min('height')) ?? 0;
        if ($userId) {
            $query = $query->whereDoesNtHave('ignoredProfile', function ($q) use ($userId) {
                $q->where('ignored_id', $userId);
            })->whereDoesNtHave('ignoredBy', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->where('id', '!=', $userId);
        }

        if ($request->member_id) {
            $query = $query->where('profile_id', $request->member_id);
        }

        if ($request->looking_for) {
            $gen = $request->looking_for == 1 ? 'm' : 'f';

            $query = $query->whereHas('basicInfo', function ($q) use ($gen) {
                $q->where('gender', 'like', "%$gen%");
            });
        }

        if ($request->height) {
            if ($minHeight == $maxHeight) {
                $minHeight = 0;
            }
            $requestedHeight = explode('-', $request->height);
            $min = trim($requestedHeight[0]);
            $max = trim(rtrim($requestedHeight[1], 'Ft'));

            if ($min != $minHeight || $max != $maxHeight) {
                $query = $query->whereHas('physicalAttributes', function ($q) use ($min, $max) {
                    $q->whereBetween('height', [$min, $max]);
                });
            }
        }

        if ($request->marital_status) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('marital_status', $request->marital_status);
            });
        }

        if ($request->religion) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('religion', $request->religion);
            });
        }

        if ($request->caste) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('caste', $request->caste);
            });
        }

        if ($request->country) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('present_address->country', $request->country);
            });
        }

        if ($request->profession) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('profession', 'like', "%$request->profession%");
            });
        }

        if ($request->city) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('present_address->city', 'like', "%$request->city%");
            });
        }

        if ($request->smoking_status) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('smoking_status', $request->smoking_status);
            });
        }

        if ($request->drinking_status) {
            $query = $query->whereHas('basicInfo', function ($q) use ($request) {
                $q->where('drinking_status', $request->drinking_status);
            });
        }
        $members = $query->with('physicalAttributes', 'limitation.package', 'basicInfo', 'interests')->orderBy('id', 'desc')->paginate(getPaginate(8));
        return ['members' => $members, 'minHeight' => $minHeight, 'maxHeight' => $maxHeight];
    }
}
