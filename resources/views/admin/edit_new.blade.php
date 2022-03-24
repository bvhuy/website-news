@extends('admin_layout')
@section('title')
<title>Chỉnh sửa bài viết - Admin</title>
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
                    Bài viết
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Chỉnh sửa
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @foreach ($edit_new as $key => $edit_news)
                    <form action="{{URL::to('/update-new/'.$edit_news->id)}}" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên bài viết </label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$edit_news->name}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="shortdescription">Tóm tắt bài viết </label>

                            <div class="col-sm-9">
                                <textarea name="shortdescription" class="form-control">{{$edit_news->shortdescription}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="thumbnail">Ảnh đại diện </label>

                            <div class="col-sm-9">
                                <input type="file" name="thumbnail" class="form-control" accept="image/*"/>
                                @if ($edit_news->thumbnail != '' || $edit_news->thumbnail != null)
                                <img src="{{URL::to('public/uploads/new/'.$edit_news->thumbnail)}}" alt="" class="col-xs-10 col-sm-5" style="padding: 0; margin-top: 5px;">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-select-4">Danh mục</label>
                            <div class="col-sm-9">
                                <select name="category_id[]" multiple="" class="chosen-select form-control tag-input-style" id="form-field-select-4" data-placeholder="Chọn danh mục...">
                                    @foreach ($list_category as $key => $categories)
                                        <option value="{{$categories->id}}"
                                            @foreach ($list_new_category as $key => $list_new_categories)
                                                @if ($list_new_categories->new_id == $edit_news->id)
                                                    @if ($list_new_categories->category_id == $categories->id)
                                                        selected
                                                    @endif
                                                @endif
                                            @endforeach
                                            >{{$categories->name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="type_id" >Danh mục con</label>
                            <div class="col-sm-9">
                                <select name="type_id[]" multiple="" class="chosen-select form-control tag-input-style" id="type_id" data-placeholder="Chọn danh mục con...">
                                    @foreach ($list_type as $key => $types)
                                        <option value="{{$types->id}}"
                                            @foreach ($list_new_category as $key => $new_categories)
                                                @if ($new_categories->new_id == $edit_news->id)
                                                    @if ($new_categories->type_id == $types->id)
                                                        selected
                                                    @endif
                                                @endif
                                            @endforeach
                                            >{{$types->name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="content">Nội dung </label>

                            <div class="col-sm-9">
                                <textarea name="content" id="edit-new-content" class="form-control">{{$edit_news->content}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="keywords">Từ khóa (seo) </label>

                            <div class="col-sm-9">
                                <input type="text" value="{{$edit_news->keywords}}" name="keywords" id="keywords" class="form-control" />
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
<script src="{{asset('public/assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('edit-new-content',{

filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
filebrowserUploadMethod: 'form'

});
</script>
@endsection