<div class="row g-0 filter-container">
    @foreach ($stories as $story)
        <div class="col-xl-3 col-lg-4 col-md-6 grid-item" data-category="1" data-sort="value">
            <img alt="@lang('Successful Story')" class="filter-img lazy-loading-img" src="{{ frontendImage('stories', 'thumb_' . $story->data_values->image, '310x205') }}" />
            <div class="grid-item__content">
                <h6 class="grid-item__name mb-1"><a class="text-decoration-none">@php echo strLimit(trans($story->data_values->title),40) @endphp</a></h6>
                <p class="grid-item__desc">
                    @php echo strLimit(strip_tags($story->data_values->description),70) @endphp
                </p>
                <a class="grid-item__link" href="{{ route('story.details', $story->slug) }}"></a>
            </div>
        </div>
    @endforeach
</div>
