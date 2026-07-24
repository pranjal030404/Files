@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="mt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
                <img src="{{ frontendImage('blog',@$blog->data_values->image,'728x465') }}" class="w-100 mb-3" alt="Blog">
                <p class="mt-2">
                    @php echo $blog->data_values->description @endphp
                </p>
			</div>
			<div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
		</div>
	</div>
</section>
@endsection
@push('fbComment')
	@php echo loadExtension('fb-comment') @endphp
@endpush
