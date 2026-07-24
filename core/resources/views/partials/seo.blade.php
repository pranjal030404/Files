@if ($seo)
    <meta name="title" Content="{{ gs()->siteName(__($pageTitle)) }}">
    <meta name="description" content="{{ isset($seoContents->description) && $seoContents->description ? $seoContents->description : $seo->description }}">
    <meta name="keywords" content="{{ implode(',', ((isset($seoContents->keywords) && $seoContents->keywords) ? $seoContents->keywords : $seo->keywords)) }}">
    <link rel="shortcut icon" href="{{ siteFavicon() }}" type="image/x-icon">
    <link rel="canonical" href="{{ url()->current() }}" />

    @if ((isset($seoContents->meta_robots) && $seoContents->meta_robots) || (isset($seo->meta_robots) && $seo->meta_robots))
        <meta name="robots" content="{{ isset($seoContents->meta_robots) && $seoContents->meta_robots ? $seoContents->meta_robots : $seo->meta_robots }}" />
    @endif

    {{-- <!-- Apple Stuff --> --}}
    <link rel="apple-touch-icon" href="{{ siteLogo() }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ gs()->siteName($pageTitle) }}">
    {{-- <!-- Google / Search Engine Tags --> --}}
    <meta itemprop="name" content="{{ gs()->siteName($pageTitle) }}">
    <meta itemprop="description" content="{{ (isset($seoContents->description) && $seoContents->description) ? $seoContents->description : $seo->description }}">
    <meta itemprop="image" content="{{ $seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image) }}">
    {{-- <!-- Facebook Meta Tags --> --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ (isset($seoContents->social_title) && $seoContents->social_title) ? $seoContents->social_title : $seo->social_title }}">
    <meta property="og:description" content="{{ (isset($seoContents->social_description) && $seoContents->social_description) ? $seoContents->social_description : $seo->social_description }}">
    <meta property="og:image" content="{{ $seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image) }}">

    <meta property="og:image:type" content="image/{{ pathinfo($seoImage ?? getImage(getFilePath('seo')) . '/' . $seo->image)['extension'] }}">
    @php $socialImageSize = explode('x', getFileSize('seo')) @endphp
    <meta property="og:image:width" content="{{ $socialImageSize[0] }}">
    <meta property="og:image:height" content="{{ $socialImageSize[1] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    {{-- <!-- Twitter Meta Tags --> --}}
    <meta name="twitter:card" content="summary_large_image">
@endif
