@if(gs('multi_language'))
    @php
        $language = App\Models\Language::all();
        $selectedLanguage = null;
        if (session('lang')) {
            $selectedLanguage = $language->where('code', config('app.locale'))->first();
        }
    @endphp
    <div class="language dropdown">
        <button class="language-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="language-content">
                <div class="language_flag">
                    <img src="{{ getImage(getFilePath('language') . '/' . @$selectedLanguage->image, getFileSize('language')) }}" alt="image">
                </div>
                <p class="language_text_select">{{ __(@$selectedLanguage->name) }}</p>
            </div>
            <span class="collapse-icon"><i class="las la-angle-down"></i></span>

        </button>

        <div class="dropdown-menu langList_dropdow py-2" style="">
            <ul class="langList">
                @foreach ($language as $item)
                    <li class="language-list">
                        <a href="{{ route('lang', $item->code) }}">
                            <div class="language_flag">
                                <img src="{{ getImage(getFilePath('language') . '/' . @$item->image, getFileSize('language')) }}" alt="image">
                            </div>
                        </a>
                        <a href="{{ route('lang', $item->code) }}">
                            <p class="language_text @if (session('lang') == $item->code) custom--dropdown__selected @endif" >{{ __($item->name) }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
