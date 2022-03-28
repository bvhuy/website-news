@extends('admin.layouts')

@section('css-finally')
 <!-- Switchery -->
 <link href="{{ asset('assets/admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
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
            <h3>Quản lý bài viết</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.news.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay
                    về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($news_id) ? 'Chỉnh sửa' : 'Thêm mới' }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::ajax([
                        'method' => isset($news_id) ? 'PUT' : 'POST',
                        'url' => isset($news_id) ? route('admin.news.update', ['news' => $news->id]) : route('admin.news.store'),
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên bài viết
                                        <span class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $news->title }}" name="news[title]" type="text" id="title"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $news->slug }}" name="news[slug]" type="text" id="slug"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="true" checked="" id="create-slug">
                                                Từ tên bài viết
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả <span
                                            class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="news[description]"
                                            class="form-control col-md-7 col-xs-12">{!! $news->description !!}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung <span
                                            class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="news[content]"
                                            class="my-editor form-control col-md-7 col-xs-12">{!! $news->content !!}</textarea>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung <span
                                            class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="news[content]"
                                            class="my-editor form-control col-md-7 col-xs-12">{!! $news->content !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_tab" aria-labelledby="data-tab">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Bài viết nổi bật</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <div class="">
                                        <label>
                                          <input name="news[hot]" type="checkbox" class="js-switch" @if($news->hot) checked @endif />
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sự kiện lịch sử</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <div class="">
                                        <label>
                                          <input name="news[event]" type="checkbox" class="js-switch" @if($news->event) checked @endif />
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Danh mục
                                        <span class="text-danger required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        @include('admin.components.form-checkbox-category-with-create', [
                                        'categories' => App\Models\Category::get(),
                                        'name' => 'news[category_id][]',
                                        'checked' => $news->categories->pluck('id')->all(),
                                        'class' => 'width-auto',
                                        ])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="thumbnail">Thumbnail</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="news[thumbnail]" type="file" id="thumbnail" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <img src="{{ isset($news->thumbnail) ? $news->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" width="100">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_seo" aria-labelledby="seo-tab">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-title">Meta
                                        title</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $news->meta_title }}" name="news[meta_title]" type="text"
                                            id="meta-title" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-description">Meta
                                        description</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="news[meta_description]" id="meta-description"
                                            class="form-control col-md-7 col-xs-12">{{ $news->meta_description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-keyword">Meta
                                        keyword</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input value="{{ $news->meta_keyword }}" name="news[meta_keyword]" type="text"
                                            id="meta-keyword" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        @if(! isset($news_id))
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
<!-- Switchery -->
<script type="text/javascript" src="{{ asset('assets/admin/vendors/switchery/dist/switchery.min.js')}}"></script>
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
                var title = $('input[name="news[title]"]').val();
                var slug = strSlug(title);
                $('input[name="news[slug]"]').val(slug);
            }
        });

        $('input[name="news[title]"]').keyup(function() {
            if ($('#create-slug').is(':checked')) {
                var title = $(this).val();
                var slug = strSlug(title);
                $('input[name="news[slug]"]').val(slug); 
            }
        });
    });


    

    // const inputElement = document.querySelector('input[type="file"]');
    // const pond = FilePond.create(inputElement);
    // FilePond.registerPlugin(FilePondPluginImagePreview);
    // FilePond.setOptions({
    // server: {
    //     url: "{{ route('admin.news.upload') }}",
    //     // process: '/process',
    //     // revert: '/process',
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     }
    // }
    // });
</script>
@endsection