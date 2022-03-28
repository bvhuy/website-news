@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý danh mục</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.category.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($category) ? 'Chỉnh sửa' : 'Thêm mới' }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::ajax([
                        'url' => isset($category_id) ? route('admin.category.update', ['category' => $category->id]) : route('admin.category.store'),
                        'class' => 'form-horizontal form-label-left form-bordered form-row-stripped',
                        'method' => isset($category_id) ? 'PUT' : 'POST',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên danh mục <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $category->name }}" name="category[name]" type="text" id="name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $category->slug }}" name="category[slug]" type="text" id="slug" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="true" checked="" id="create-slug">
                                        Từ tên danh mục
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                @include('admin.components.form-select-category', [
                                    'categories' => $category->parentAble()->get(),
                                    'name' => 'category[parent_id]',
                                    'selected' => isset($category_id) ? $category->parent_id : '',
                                ])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p>Để trống nếu bạn muốn danh mục này là danh mục gốc</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-title">Meta title</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $category->meta_title }}" name="category[meta_title]" type="text" id="meta-title" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-description">Meta description</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea name="category[meta_description]" id="meta-title" class="form-control col-md-7 col-xs-12">{{ $category->meta_description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meta-keyword">Meta keyword</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $category->meta_keyword }}" name="category[meta_keyword]" type="text" id="meta-keyword" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thumbnail">Thumbnail</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="category[thumbnail]" type="file" id="thumbnail" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <img src="{{ isset($category->thumbnail) ? $category->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" width="100">                               
                            </div>
                        </div>       
                    </div>
                    <div class="ln_solid"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                
                        @if(! isset($category_id))
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
@section('js')

<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
    $('#create-slug').click(function() {
        if(this.checked) {
            var title = $('input[name="category[name]"]').val();
            var slug = strSlug(title);
            $('input[name="category[slug]"]').val(slug);
        }
    });

    $('input[name="category[name]"]').keyup(function() {
        if ($('#create-slug').is(':checked')) {
            var title = $(this).val();
            var slug = strSlug(title);
            $('input[name="category[slug]"]').val(slug);	
        }
    });
</script>
@endsection