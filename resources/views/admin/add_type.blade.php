@extends('admin_layout')
@section('title')
<title>Thêm danh mục con - Admin</title>
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
                    Danh mục con
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Thêm
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form action="{{URL::to('/save-type')}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Nhập tên danh mục con..." value="{{old('name')}}" name="name" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="category_id">Danh mục</label>
                            <div class="col-sm-9">
                                <select name="category_id[]" multiple="" class="chosen-select form-control tag-input-style" id="category_id" data-placeholder="Chọn danh mục">
                                    @foreach ($list_category as $key => $categories)
                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="shortdescription"> Mô tả ngắn (seo) </label>

                            <div class="col-sm-9">
                                <textarea name="shortdescription" placeholder="Nhập mô tả ngắn..." class="form-control">{{old('shortdescription')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="keywords">Từ khóa (seo) </label>

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

@section('js')
<script src="{{asset('public/assets/js/chosen.jquery.min.js')}}"></script>
@endsection

@section('custom-js')
<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true}); 
            //resize the chosen on window resize
    
            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
                })
            });
        }
    });
</script>
@endsection