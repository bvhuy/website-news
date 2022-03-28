@extends('admin.layouts')

@section('css-finally')

@endsection

@section('css')

<link rel="stylesheet" href="https://unpkg.com/filepond@^4/dist/filepond.css" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>

<link rel="stylesheet" href="{{ asset('assets/admin/global/css/plugins-md.min.css') }}" /> 
<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/icheck/skins/all.css') }}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý video</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.video.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay
                    về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($video_id) ? 'Chỉnh sửa' : 'Thêm mới' }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::ajax([
                        'method' => isset($video_id) ? 'PUT' : 'POST',
                        'url' => isset($video_id) ? route('admin.video.update', ['video' => $video->id]) : route('admin.video.store'),
                        'class' => 'form-horizontal form-label-left form-bordered form-row-stripped',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content" id="content-tab" role="tab"
                                    data-toggle="tab" aria-expanded="true">Nội dung</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_tab" role="tab" id="data-tab"
                                    data-toggle="tab" aria-expanded="false">Dữ liệu</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_seo" role="tab" id="seo-tab"
                                    data-toggle="tab" aria-expanded="false">SEO</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content"
                                aria-labelledby="content-tab">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên video
                                        <span class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $video->title }}" name="video[title]" type="text" id="title"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $video->slug }}" name="video[slug]" type="text" id="slug"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="true" checked="" id="create-slug">
                                                Từ tên video
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Link Youtube
                                        <span class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $video->url }}" name="video[url]" type="text" id="url"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_tab" aria-labelledby="data-tab">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Danh mục
                                        <span class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        @include('admin.components.form-checkbox-category-video-with-create', [
                                        'categories' => App\Models\CategoryVideo::get(),
                                        'name' => 'video[category_video_id][]',
                                        'checked' => $video->categories->pluck('id')->all(),
                                        'class' => 'width-auto',
                                        ])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="thumbnail">Thumbnail</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="video[thumbnail]" type="file" id="thumbnail" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <img src="{{ isset($video->thumbnail) ? $video->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" width="100">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_seo" aria-labelledby="seo-tab">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-title">Meta
                                        title</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $video->meta_title }}" name="video[meta_title]" type="text"
                                            id="meta-title" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-description">Meta
                                        description</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="video[meta_description]" id="meta-description"
                                            class="form-control col-md-7 col-xs-12">{{ $video->meta_description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-keyword">Meta
                                        keyword</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $video->meta_keyword }}" name="video[meta_keyword]" type="text"
                                            id="meta-keyword" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        @if(! isset($video_id))
                        {!! Form::btnSaveNew() !!}
                        @else
                        {!! Form::btnSaveOut() !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-finally')

@endsection

@section('js')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script type="text/javascript" src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/tinymce/tinymce.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/icheck/icheck.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('#create-slug').click(function() {
            if(this.checked) {
                var title = $('input[name="video[title]"]').val();
                var slug = strSlug(title);
                $('input[name="video[slug]"]').val(slug);
            }
        });

        $('input[name="video[title]"]').keyup(function() {
            if ($('#create-slug').is(':checked')) {
                var title = $(this).val();
                var slug = strSlug(title);
                $('input[name="video[slug]"]').val(slug); 
            }
        });
    });


    

    // const inputElement = document.querySelector('input[type="file"]');
    // const pond = FilePond.create(inputElement);
    // FilePond.registerPlugin(FilePondPluginImagePreview);
    // FilePond.setOptions({
    // server: {
    //     url: "{{ route('admin.video.upload') }}",
    //     // process: '/process',
    //     // revert: '/process',
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     }
    // }
    // });
</script>
@endsection