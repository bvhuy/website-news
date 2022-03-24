@extends('admin_layout')
@section('title')
<title>Chỉnh sửa Video - Admin</title>
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
                        Chỉnh sửa
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @foreach ($video as $key => $result)
                    <form action="{{URL::to('/update-video/'.$result->id)}}" class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Tên Video</label>

                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" value="{{ $result->name }}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Code link Youtube</label>

                            <div class="col-sm-9">
                                <input type="text" name="code" id="code" value="{{ $result->code }}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <p class="alert alert-success">https://www.youtube.com/watch?v=<mark style="background-color: yellow">4n46v-InhH8</mark>&ab_channel=ViệtNamTổQuốcTôiYêu</p>
                                <p class="alert alert-info">Code link Youtube là phần tô màu vàng</p>
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
                                    Làm mới
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