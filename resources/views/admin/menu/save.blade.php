@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý Menu</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($menu_id) ? 'Chỉnh sửa' : 'Thêm mới' }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::ajax([
                        'url' => isset($menu_id) ? route('admin.menu.update', ['menu' => $menu->id]) : route('admin.menu.store'),
                        'class' => 'form-horizontal form-label-left',
                        'method' => isset($menu_id) ? 'PUT' : 'POST'
                    ]) !!}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên menu <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $menu->name }}" name="menu[name]" type="text" id="name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $menu->slug }}" name="menu[slug]" type="text" id="slug"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="true" checked="" id="create-slug">
                                        Từ tên menu
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                @include('admin.components.form-select-menu', [
                                    'menus' => $menu->parentAble()->get(),
                                    'name' => 'menu[parent_id]',
                                    'selected' => isset($menu_id) ? $menu->parent_id : '',
                                ])
                            </div>
                        </div> 
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                
                                @if(! isset($menu_id))
                                    {!! Form::btnSaveNew() !!}
                                @else
                                    {!! Form::btnSaveOut() !!}
                                @endif
                            </div>
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
    $(function(){
        $('#create-slug').click(function() {
            if(this.checked) {
                var name = $('input[name="menu[name]"]').val();
                var slug = strSlug(name);
                $('input[name="news[slug]"]').val(slug);
            }
        });

        $('input[name="menu[name]"]').keyup(function() {
            if ($('#create-slug').is(':checked')) {
                var name = $(this).val();
                var slug = strSlug(name);
                $('input[name="menu[slug]"]').val(slug); 
            }
        });
    });
</script>
@endsection