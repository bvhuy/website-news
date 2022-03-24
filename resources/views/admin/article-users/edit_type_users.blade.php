@extends('admin_layout')
@section('title')
<title>Chỉnh sửa danh mục bài viết</title>
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
                    Danh mục con bài viết
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Chỉnh sửa
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @foreach ($edit_type as $key => $edit_types)
                    <form action="{{URL::to('/update-type-users/'.$edit_types->id)}}" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên danh mục con </label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$edit_types->name}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="category_id">Danh mục</label>
                            <div class="col-sm-9">
                                <select name="category_id[]" multiple="" class="chosen-select form-control tag-input-style" id="category_id">
                                    @foreach ($list_category as $key => $categories)
                                        <option value="{{$categories->id}}"
                                            @foreach ($list_type_category as $key => $list_type_categories)
                                                @if ($list_type_categories->type_id == $edit_types->id)
                                                    @if ($list_type_categories->category_id == $categories->id)
                                                        selected
                                                    @endif
                                                @endif
                                            @endforeach>
                                            {{$categories->name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="shortdescription"> Mô tả ngắn </label>

                            <div class="col-sm-9">
                                <textarea name="shortdescription" id="shortdescription"  class="form-control">{{$edit_types->shortdescription}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="keywords">Từ khóa </label>

                            <div class="col-sm-9">
                                <input type="text" value="{{$edit_types->keywords}}" name="keywords" id="keywords" class="form-control" />
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Cập Nhật
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
@section('js')
<script src="{{asset('public/assets/js/chosen.jquery.min.js')}}"></script>
@endsection

@section('custom-js')
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