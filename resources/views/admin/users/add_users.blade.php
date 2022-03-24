@extends('admin_layout')
@section('title')
<title>Thêm tài khoản - Admin</title>
@endsection
@section('dashboard')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Quản lý tài khoản
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Thêm
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form action="{{URL::to('store-users')}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="admin_name"> Họ & Tên </label>

                            <div class="col-sm-9">
                                <input type="text" name="admin_name" value="{{old('admin_name')}}" id="admin_name" placeholder="Nhập họ & tên của bạn..." class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="admin_email"> Email </label>

                            <div class="col-sm-9">
                                <input type="email" name="email" value="{{old('email')}}" id="email" placeholder="Nhập địa chỉ Email của bạn..." class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="admin_password"> Mật khẩu </label>

                            <div class="col-sm-9">
                                <input type="password" name="admin_password" value="{{old('admin_password')}}" id="admin_password" placeholder="Nhập mật khẩu..." class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Thêm
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Làm mới
                                </button>
                            </div>
                        </div>
                    </form><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection