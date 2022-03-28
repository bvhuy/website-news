@extends('admin.layouts')

@section('css-finally')
 <!-- iCheck -->
 <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iCheck/skins/flat/green.css') }}">
 <!-- Switchery -->
 <link href="{{ asset('assets/admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@endsection
@section('css')

<link rel="stylesheet" href="{{ asset('assets/admin/global/css/plugins-md.min.css') }}" /> 
<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" />

@endsection

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý người dùng</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.user.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay
                    về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ isset($user_id) ? 'Chỉnh sửa' : 'Thêm mới' }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::ajax([
                        'url' => isset($user_id) ? route('admin.user.update', ['user' => $user->id]) : route('admin.user.store'),
                        'class' => 'form-horizontal form-label-left form-bordered form-row-stripped',
                        'method' => isset($user_id) ? 'PUT' : 'POST'
                    ]) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Họ và tên đệm <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $user->last_name }}" name="user[last_name]" type="text" id="last_name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Tên đầu <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $user->first_name }}" name="user[first_name]" type="text" id="first_name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bí danh <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $user->name }}"  name="user[name]" type="text" id="name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $user->email }}" name="user[email]" type="text" id="email" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        @if(! isset($user_id))
                            <div class="form-group has-feedback">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Mật khẩu <span class="text-danger required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="user[password]" type="password" type="text" id="password" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>     
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Xác nhận mật khẩu <span class="text-danger required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="user[password_confirmation]" type="password" id="password_confirmation" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div class="">
                                    <label>
                                      <input type="checkbox" class="js-switch" view-password /> Hiển thị mật khẩu
                                    </label>
                                  </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Quyền quản trị <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::select('user[role_id]', App\Models\Role::where('type', '!=', '*')->get()->mapWithKeys(function ($item) {
                                    return [$item->id => $item->name];
                                }), isset($user_id) ? $user->role_id : NULL, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái <span class="text-danger required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::select('user[status]', App\Models\User::statusable()->mapWithKeys(function ($item) {
                                return [$item['slug'] => $item['name']];
                            })->all(), $user->status_slug, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                
                        @if(! isset($user_id))
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
<!-- iCheck -->
<script type="text/javascript" src="{{ asset('assets/admin/vendors/iCheck/icheck.min.js')}}"></script>
<!-- Switchery -->
<script type="text/javascript" src="{{ asset('assets/admin/vendors/switchery/dist/switchery.min.js')}}"></script>
@endsection
@section('js')


<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js')}}"></script>

<script type="text/javascript">
    $(function(){
        $('*[view-password]').change(function(){
            if(this.checked) {
                $('*[name="user[password]"]').attr('type','text');
                $('*[name="user[password_confirmation]"]').attr('type','text');
            } else {
                $('*[name="user[password]"]').attr('type','password');
                $('*[name="user[password_confirmation]"]').attr('type','password');
            }
        });
    });
</script>
@endsection