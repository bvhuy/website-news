@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý người dùng</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('user.list-user') }}</h2>
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
                                    <th style="width: 20%">{{ trans('user.name') }}</th>
                                    <th>Vai trò người dùng</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 15%">Ngày tạo</th>
                                    <th style="width: 15%">Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($users as $user)
                                <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                            
                                <?php $dash=''; ?>
                                    <tr>
                                        <td>{{$_SESSION['i']}}</td>
                                        <td>
                                            <p>{{ $user->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ optional($user->role)->name }}</p>
                                        </td>
                                        <td>
                                            @if(!$user->isSelf() && !$user->role->isFull())
                                                @if($user->isDisable())
                                                    <a data-function="enable" data-method="put" href="{{ route('admin.user.enable' , ['user' => $user->id]) }}" class="btn btn-danger btn-xs">Tắt</a>
                                                @endif
                                                @if($user->isEnable())
                                                    <a data-function="disable" data-method="put" href="{{ route('admin.user.disable' , ['user' => $user->id]) }}" class="btn btn-success btn-xs">Bật</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <p><i class="fa fa-clock-o"></i> {{ $user->created_at }}</p>
                                            <p>{{ $user->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <p><i class="fa fa-clock-o"></i> {{ $user->updated_at }}</p>
                                            <p>{{ $user->updated_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            @if(!$user->isSelf() && !$user->role->isFull())
                                            <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>
    
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-{{ $user->id }}"><i class="fa fa-trash-o"></i> Xoá </button>
    
                                            <div class="modal fade confirm-delete-{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">
                            
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                      <a data-function="destroy" data-method="delete" href="{{ route('admin.user.destroy', ['user' => $user->id]) }}" class="btn btn-danger">Xoá</a>
                                                    </div>
                            
                                                  </div>
                                                </div>
                                              </div>
                                            @endif
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
                            {{ $users->links('vendor.pagination.bootstrap-4') }}
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