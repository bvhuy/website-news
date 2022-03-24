@extends('admin_layout')
@section('title')
<title>Chỉnh sửa danh mục - Admin</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/assets/css/chosen.min.css')}}" />
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
                        Chỉnh sửa
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @foreach ($edit_category as $key => $edit_categories)
                    <form action="{{URL::to('/update-category/'.$edit_categories->id)}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name"> Tên danh mục</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$edit_categories->name}}" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="shortdescription"> Mô tả ngắn (seo) </label>

                            <div class="col-sm-9">
                                <textarea name="shortdescription" id="shortdescription"  class="form-control">{{$edit_categories->shortdescription}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="keywords">Từ khóa (seo) </label>

                            <div class="col-sm-9">
                                <input type="text" value="{{$edit_categories->keywords}}" name="keywords" id="keywords" class="form-control" />
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Chỉnh sửa
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Làm Mới
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach 
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection