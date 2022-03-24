@extends('admin_layout')
@section('title')
<title>Thêm video - Admin</title>
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
                    Video
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Thêm
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form action="{{URL::to('/save-video')}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên Video</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Nhập tên Video..." name="name" id="name" value="{{old('name')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Code link Youtube</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Nhập code link Youtube..." name="code" id="code" value="{{old('code')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <p class="alert alert-success">https://www.youtube.com/watch?v=<mark style="background-color: yellow">4n46v-InhH8</mark>&ab_channel=ViệtNamTổQuốcTôiYêu</p>
                                <p class="alert alert-info">Code link Youtube là phần tô màu vàng</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status">Hiển thị ngoài trang chủ</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
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