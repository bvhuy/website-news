@extends('admin.layouts')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/global/css/plugins-md.min.css') }}" /> 
<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" />
@endsection
@section('css-finally')
<!-- Select2 -->
<link href="{{ asset('assets/admin/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Cài đặt chung</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Form::ajax(['method' => 'PUT', 'url' => route('admin.setting.general.update'), 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thông tin chung</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- start project list -->
                    <br />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên Website</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="website_name" value="{{ $website_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Link Website</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="website_url" value="{{ $website_url }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Giới thiệu</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="website_about">{{ $website_about }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="website_phone" value="{{ $website_phone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="email" class="form-control col-md-7 col-xs-12" name="website_email" value="{{ $website_email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="website_address">{{ $website_address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                            for="logo">Logo Website</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="logo" type="file" id="logo" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img src="{{ $logo }}" class="img-responsive">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                            for="logo">Favicon Website</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="favicon" type="file" id="favicon" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img src="{{ $favicon }}" class="img-responsive">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                            for="default_thumbnail">Thumbnail</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="default_thumbnail" type="file" id="default_thumbnail" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <img src="{{ $default_thumbnail }}" class="img-responsive" width="200">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end project list -->
            <div class="x_panel">
                <div class="x_title">
                    <h2>SEO</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- start project list -->
                    <br />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook App ID </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="facebook_app_id" value="{{ $facebook_app_id }}">
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Trang chủ</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start project list -->
                            <br />
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta title</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="home_title" value="{{ $home_title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta description </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="home_description">{{ $home_description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta keyword</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="home_keyword">{{ $home_keyword }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- end project list -->
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tìm kiếm</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start project list -->
                            <br />
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta title</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="search_title" value="{{ $search_title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta description </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="search_description">{{ $search_description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Meta keyword</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="search_keyword">{{ $search_keyword }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- end project list -->
                    </div>
                </div>
                <!-- end project list -->
            </div>
            <!-- end project list -->
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mạng xã hội</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- start project list -->
                    <br />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="social_facebook" value="{{ $social_facebook }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Youtube</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="social_youtube" value="{{ $social_youtube }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Zalo</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="social_zalo" value="{{ $social_zalo }}">
                        </div>
                    </div>
                </div>
                <!-- end project list -->
            </div>
            <!-- end project list -->
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    {!! Form::btnSaveCancel() !!}
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
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js')}} "></script>
@endsection
@section('js-finally')
<!-- jQuery Tags Input -->
<script src="{{ asset('assets/admin/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
@endsection