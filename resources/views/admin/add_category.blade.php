@extends('admin_layout')
@section('title')
<title>Thêm danh mục bài viết - Admin</title>
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
                    Danh mục bài viết
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Thêm
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form action="{{URL::to('/save-category')}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên </label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Nhập tên danh mục..." name="name" id="name" value="{{old('name')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="shortdescription"> Mô tả ngắn (Seo) </label>

                            <div class="col-sm-9">
                                <textarea name="shortdescription" placeholder="Nhập mô tả ngắn..." class="form-control">{{old('shortdescription')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="keywords">Từ khóa (Seo)</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Nhập từ khóa..." name="keywords" id="keywords" value="{{old('keywords')}}" class="form-control" />
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