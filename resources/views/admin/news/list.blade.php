@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý bài viết</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.news.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects table-function-container">
                            <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 20%">Tên bài viết</th>
                                    <th>Thumbnail</th>
                                    <th>Lượt xem</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 15%">Ngày tạo</th>
                                    <th style="width: 15%">Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($news as $new)
                                <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                                <?php $dash=''; ?>
                                    <tr>
                                        <td>{{$_SESSION['i']}}</td>
                                        <td>
                                            <a href="{{ route('admin.news.edit', ['news' => $new->id]) }}">{{ $new->title }}</a>
                                        </td>
                                        <td>
                                            <img src="{{ isset($new->thumbnail) ? $new->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" {{ isset($new->thumbnail) ? 'width=50' : 'width=50' }}>                               
                                        </td>    
                                        <td>
                                            <p>{{ views($new)->unique()->count() }}</p>
                                        </td>                                     
                                        <td>
                                            @if($new->isDisable())
                                                <a data-function="enable" data-method="put" href="{{ route('admin.news.enable' , ['news' => $new->id]) }}" class="btn btn-danger btn-xs">Ẩn</a>
                                            @endif
                                            @if($new->isEnable())
                                                <a data-function="disable" data-method="put" href="{{ route('admin.news.disable' , ['news' => $new->id]) }}" class="btn btn-success btn-xs">Hiện</a>
                                            @endif
                                        </td>
                                        <td>
                                            <p><i class="fa fa-user"></i> {{ optional($new->author)->name }}</p>
                                            <p><i class="fa fa-clock-o"></i> {{ $new->created_at }}</p>
                                            <p>{{ $new->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <p><i class="fa fa-user"></i> {{ optional($new->author)->name }}</p>
                                            <p><i class="fa fa-clock-o"></i> {{ $new->updated_at }}</p>
                                            <p>{{ $new->updated_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.news.edit', ['news' => $new->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-news-{{ $new->id }}"><i class="fa fa-trash-o"></i> Xoá </button>
                                            <div class="modal fade confirm-delete-news-{{ $new->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">    
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                      <a data-function="destroy" data-method="delete" href="{{ route('admin.news.destroy', ['news' => $new->id]) }}" class="btn btn-danger">Xoá</a>
                                                    </div>                           
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                 
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
    <!--box-pagination-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Phân trang
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $news->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-box-pagination-->
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js')}} "></script>
@endsection