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
                <a href="{{ route('admin.role.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('user.role') }}</h2>
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
                                    <th style="width: 20%">{{ trans('role.name') }}</th>
                                    <th style="width: 15%">Ngày tạo</th>
                                    <th style="width: 15%">Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($roles as $role)
                                <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                            
                                <?php $dash=''; ?>
                                    <tr>
                                        <td>{{$_SESSION['i']}}</td>
                                        <td>
                                            <p>{{ $role->name }}</p>
                                        </td>
                                        <td>
                                            <p><i class="fa fa-clock-o"></i> {{ $role->created_at }}</p>
                                            <p>{{ $role->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <p><i class="fa fa-clock-o"></i> {{ $role->updated_at }}</p>
                                            <p>{{ $role->updated_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            @if(!$role->isFull())
                                            <a href="{{ route('admin.role.edit', ['role' => $role->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>
    
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-{{ $role->id }}"><i class="fa fa-trash-o"></i> Xoá </button>
    
                                            <div class="modal fade confirm-delete-{{ $role->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">
                            
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                      <a data-function="destroy" data-method="delete" href="{{ route('admin.role.destroy', ['role' => $role->id]) }}" class="btn btn-danger">Xoá</a>
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
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js')}} "></script>
@endsection