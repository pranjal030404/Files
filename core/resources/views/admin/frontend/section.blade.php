@extends('admin.layouts.app')

@section('panel')
    @if (isset($section->content))
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.frontend.sections.content', $key) }}" class="disableSubmission" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="content">
                            <div class="row">
                                @php
                                    $imgCount = 0;
                                @endphp
                                @foreach ($section->content as $k => $item)
                                    @if ($k == 'images')
                                        @php
                                            $imgCount = collect($item)->count();
                                        @endphp
                                        @foreach ($item as $imgKey => $image)
                                            <div class="col-md-4">
                                                <input type="hidden" name="has_image" value="1">
                                                <div class="form-group">
                                                    <label>{{ __(keyToTitle($imgKey)) }}</label>
                                                    <x-image-uploader class="w-100" name="image_input[{{ $imgKey }}]" :imagePath="frontendImage($key,(isset($content->data_values->$imgKey) ? $content->data_values->$imgKey : ''), (isset($section->content->images->$imgKey->size) ? $section->content->images->$imgKey->size  : null))" id="image-upload-input{{ $loop->index }}" :size="$section->content->images->$imgKey->size" :required="false" />
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="@if ($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                            @push('divend')
                                            </div>
                                        @endpush
                                    @else
                                        @if ($k != 'images')
                                            @if ($item == 'icon')
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>{{ __(keyToTitle($k)) }}</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control iconPicker icon" autocomplete="off" name="{{ $k }}" value="{{ isset($content->data_values->$k) ? $content->data_values->$k : '' }}" required>
                                                            <span class="input-group-text  input-group-addon" data-icon="las la-home" role="iconpicker"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($item == 'textarea')
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(keyToTitle($k)) }}</label>
                                                        <textarea rows="10" class="form-control" name="{{ $k }}" required>{{ isset($content->data_values->$k) ? $content->data_values->$k : '' }}</textarea>
                                                    </div>
                                                </div>
                                            @elseif($item == 'textarea-nic')
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(keyToTitle($k)) }}</label>
                                                        <textarea rows="10" class="form-control nicEdit" name="{{ $k }}">{{ isset($content->data_values->$k) ? $content->data_values->$k : '' }}</textarea>
                                                    </div>
                                                </div>
                                            @elseif($k == 'select')
                                                @php
                                                    $selectName = $item->name;
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(keyToTitle($selectName)) }}</label>
                                                        <select class="form-control select2" data-minimum-results-for-search="-1" name="{{ $selectName }}">
                                                            @foreach ($item->options as $selectItemKey => $selectOption)
                                                                <option value="{{ $selectItemKey }}" @if ((isset($content->data_values->$selectName) ? $content->data_values->$selectName : '') == $selectItemKey) selected @endif>{{ $selectOption }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(keyToTitle($k)) }}</label>
                                                        <input type="text" class="form-control" name="{{ $k }}" value="{{ isset($content->data_values->$k) ? $content->data_values->$k : '' }}" required>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                                @stack('divend')
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset($section->element))
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="d-inline">
                <div class="input-group justify-content-end">
                    <input type="text" name="search_table" class="form-control bg--white" placeholder="@lang('Search')...">
                    <button class="btn btn--primary input-group-text"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light style--two custom-data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('SL')</th>
                                        @if (isset($section->element->images))
                                            <th>@lang('Image')</th>
                                        @endif
                                        @foreach ($section->element as $k => $type)
                                            @if ($k != 'modal' && $k != 'seo')
                                                @if ($type == 'text' || $type == 'icon')
                                                    <th>{{ __(keyToTitle($k)) }}</th>
                                                @elseif($k == 'select')
                                                    <th>{{ keyToTitle( isset($section->element->$k->name) ? $section->element->$k->name : '') }}</th>
                                                @endif
                                            @endif
                                        @endforeach
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @forelse($elements as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if (isset($section->element->images))
                                                @php $firstKey = collect($section->element->images)->keys()[0]; @endphp
                                                <td>

                                                    <div class="user d-flex">
                                                        <div class="thumb me-2">
                                                            <img src="{{ frontendImage($key, (isset($data->data_values->$firstKey) ? $data->data_values->$firstKey : ''), isset($section->element->images->$firstKey->size) ? $section->element->images->$firstKey->size : null) }}" alt="image">
                                                        </div>
                                                    </div>

                                                </td>
                                            @endif
                                            @foreach ($section->element as $k => $type)
                                                @if ($k != 'modal' && $k != 'seo')
                                                    @if ($type == 'text' || $type == 'icon')
                                                        @if ($type == 'icon')
                                                            <td>@php echo isset($data->data_values->$k) ? $data->data_values->$k : ''; @endphp</td>
                                                        @else
                                                            <td>{{ isset($data->data_values->$k) ? __($data->data_values->$k) : '' }}</td>
                                                        @endif
                                                    @elseif($k == 'select')
                                                        @php
                                                            $dataVal = isset($section->element->$k->name) ? $section->element->$k->name : '';
                                                        @endphp
                                                        <td>{{  isset($data->data_values->$dataVal) ? $data->data_values->$dataVal : '' }}</td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <td>
                                                <div class="button--group">
                                                    @if(isset($section->element->seo) &&  $section->element->seo)
                                                        <a href="{{ route('admin.frontend.sections.element.seo', [$key,$data->id]) }}" class="btn btn-sm btn-outline--info"><i class="la la-cog"></i> @lang('SEO Setting')</a>
                                                    @endif
                                                    @if ($section->element->modal)
                                                        @php
                                                            $images = [];
                                                            if (isset($section->element->images)) {
                                                                foreach ($section->element->images as $imgKey => $imgs) {
                                                                    $images[] = frontendImage($key, isset($data->data_values->$imgKey) ? $data->data_values->$imgKey : '', isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null);
                                                                }
                                                            }
                                                        @endphp
                                                        <button class="btn btn-sm btn-outline--primary updateBtn" data-id="{{ $data->id }}" data-all="{{ json_encode($data->data_values) }}" @if (isset($section->element->images)) data-images="{{ json_encode($images) }}" @endif>
                                                            <i class="la la-pencil-alt"></i> @lang('Edit')
                                                        </button>
                                                    @else
                                                        <a href="{{ route('admin.frontend.sections.element', [$key, $data->id]) }}" class="btn btn-sm btn-outline--primary"><i class="la la-pencil-alt"></i> @lang('Edit')</a>
                                                    @endif
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.frontend.remove', $data->id) }}" data-question="@lang('Are you sure to remove this item?')"><i class="la la-trash"></i> @lang('Remove')</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add METHOD MODAL --}}
        <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add New') {{ __(keyToTitle($key)) }} @lang('Item')</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.frontend.sections.content', $key) }}" class="disableSubmission" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        <div class="modal-body">
                            @foreach ($section->element as $k => $type)
                                @if ($k != 'modal')
                                    @if ($type == 'icon')
                                        <div class="form-group">
                                            <label>{{ __(keyToTitle($k)) }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control iconPicker icon" autocomplete="off" name="{{ $k }}" required>
                                                <span class="input-group-text  input-group-addon" data-icon="las la-home" role="iconpicker"></span>
                                            </div>
                                        </div>
                                    @elseif($k == 'select')
                                        <div class="form-group">
                                            <label>{{ isset($section->element->$k->name) ? keyToTitle($section->element->$k->name) : '' }}</label>
                                            <select class="form-control" name="{{ isset($section->element->$k->name) ? $section->element->$k->name : '' }}">
                                                @foreach ($section->element->$k->options as $selectKey => $options)
                                                    <option value="{{ $selectKey }}">{{ $options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($k == 'images')
                                        @foreach ($type as $imgKey => $image)
                                            <input type="hidden" name="has_image" value="1">
                                            <div class="form-group">
                                                <label>{{ __(keyToTitle($imgKey)) }}</label>

                                                <x-image-uploader class="w-100" name="image_input[{{ $imgKey }}]" :imagePath="getImage('', isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null)" id="addImage{{ $loop->index }}" :size=" isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null " />
                                            </div>
                                        @endforeach
                                    @elseif($type == 'textarea')
                                        <div class="form-group">
                                            <label>{{ __(keyToTitle($k)) }}</label>
                                            <textarea rows="4" class="form-control" name="{{ $k }}" required></textarea>
                                        </div>
                                    @elseif($type == 'textarea-nic')
                                        <div class="form-group">
                                            <label>{{ __(keyToTitle($k)) }}</label>
                                            <textarea rows="4" class="form-control nicEdit" name="{{ $k }}"></textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>{{ __(keyToTitle($k)) }}</label>
                                            <input type="text" class="form-control" name="{{ $k }}" required>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update METHOD MODAL --}}
        <div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Update') {{ __(keyToTitle($key)) }} @lang('Item')</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.frontend.sections.content', $key) }}" class="edit-route disableSubmission" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            @foreach ($section->element as $k => $type)
                                @if ($k != 'modal')
                                    @if ($type == 'icon')
                                        <div class="form-group">
                                            <label>{{ keyToTitle($k) }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control iconPicker icon" autocomplete="off" name="{{ $k }}" required>
                                                <span class="input-group-text  input-group-addon" data-icon="las la-home" role="iconpicker"></span>
                                            </div>
                                        </div>
                                    @elseif($k == 'select')
                                        <div class="form-group">
                                            <label>{{ isset($section->element->$k->name) ? keyToTitle($section->element->$k->name) : '' }}</label>
                                            <select class="form-control" name="{{ isset($section->element->$k->name) ? $section->element->$k->name : '' }}">
                                                @foreach ($section->element->$k->options as $selectKey => $options)
                                                    <option value="{{ $selectKey }}">{{ $options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($k == 'images')
                                        @foreach ($type as $imgKey => $image)
                                            <input type="hidden" name="has_image" value="1">
                                            <div class="form-group">
                                                <label>{{ __(keyToTitle($k)) }}</label>

                                                <x-image-uploader class="w-100" :imagePath="getImage('', $section->element->images->$imgKey->size)" name="image_input[{{ $imgKey }}]" id="updateImage{{ $loop->index }}" :size="isset($section->element->images->$imgKey->size) ? $section->element->images->$imgKey->size : null" :required="false" />

                                            </div>
                                        @endforeach
                                    @elseif($type == 'textarea')
                                        <div class="form-group">
                                            <label>{{ keyToTitle($k) }}</label>
                                            <textarea rows="4" class="form-control" name="{{ $k }}" required></textarea>
                                        </div>
                                    @elseif($type == 'textarea-nic')
                                        <div class="form-group">
                                            <label>{{ keyToTitle($k) }}</label>
                                            <textarea rows="4" class="form-control nicEdit" name="{{ $k }}"></textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>{{ keyToTitle($k) }}</label>
                                            <input type="text" class="form-control" name="{{ $k }}" required>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- if section element end --}}

    <x-confirmation-modal />

@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center">
        @if (isset($section->element))
            @if ($section->element->modal)
                <a href="javascript:void(0)" class="btn btn-sm btn-outline--primary addBtn"><i class="las la-plus"></i>@lang('Add New')</a>
            @else
                <a href="{{ route('admin.frontend.sections.element', $key) }}" class="btn btn-sm btn-outline--primary"><i class="las la-plus"></i>@lang('Add New')</a>
            @endif
        @endif
        @if (!empty($templates))
            <div class="form-inline float-sm-end">
                <form action="{{ route('admin.frontend.import', $key) }}" method="post">
                    <div class="input-group">
                        @csrf
                        <select name="template_name" class="form-control form-control-sm border--primary h-auto">
                            <option value="">@lang('Select One')</option>
                            @foreach ($templates as $template)
                                <option value="{{ $template['name'] }}">{{ __(keyToTitle($template['name'])) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="input-group-text btn btn-sm btn--primary">@lang('Import')</button>
                    </div>
                </form>
            </div>
        @endif
        @if(!isset($section->hide_builder) || (isset($section->hide_builder) && !$section->hide_builder))
        <x-back route="{{ route('admin.frontend.index') }}" />
        @endif
    </div>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.addBtn').on('click', function() {
                var modal = $('#addModal');
                modal.modal('show');
            });

            $(document).on('click','.updateBtn', function() {
                var modal = $('#updateBtn');
                modal.find('input[name=id]').val($(this).data('id'));

                var obj = $(this).data('all');
                var images = $(this).data('images');

                var imagePreviews = modal.find('.image-upload-preview');


                if (images) {

                    for (var i = 0; i < images.length; i++) {

                        var imgloc = images[i];
                        $(imagePreviews[i]).css("background-image", "url(" + imgloc + ")");
                    }
                }
                $.each(obj, function(index, value) {
                    modal.find('[name=' + index + ']').val(value);
                });
                modal.modal('show');
            });

            $('#updateBtn').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('#addModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
