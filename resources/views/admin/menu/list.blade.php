@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý Menu</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.menu.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Menu</h2>
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
                                    <th>Tên menu</th>
                                    <th>Sắp xếp</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($menus as $menu)
                                <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                            
                                <?php $dash=''; ?>
                                    <tr>
                                        <td>{{$_SESSION['i']}}</td>
                                        <td>
                                            <a href="{{ route('admin.menu.edit', ['menu' => $menu->id]) }}" class="btn btn-info btn-xs">{{ $menu->name }}</a>
                                        </td>
                                        <td>
                                            @if ($menu->getNextSibling())
                                                <a href="{{ route('admin.menu.down' , ['menu' => $menu->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-arrow-down"></i></a>
                                            @endif
                                            @if ($menu->getPrevSibling())
                                                <a href="{{ route('admin.menu.up' , ['menu' => $menu->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-up"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($menu->isDisable())
                                                <a data-function="enable" data-method="put" href="{{ route('admin.menu.enable' , ['menu' => $menu->id]) }}" class="btn btn-danger btn-xs">Ẩn</a>
                                            @endif
                                            @if($menu->isEnable())
                                                <a data-function="disable" data-method="put" href="{{ route('admin.menu.disable' , ['menu' => $menu->id]) }}" class="btn btn-success btn-xs">Hiện</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.menu.edit', ['menu' => $menu->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>
    
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-{{ $menu->id }}"><i class="fa fa-trash-o"></i> Xoá </button>
    
                                            <div class="modal fade confirm-delete-{{ $menu->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">
                            
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                      <a data-function="destroy" data-method="delete" href="{{ route('admin.menu.destroy', ['menu' => $menu->id]) }}" class="btn btn-danger">Xoá</a>
                                                    </div>
                            
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                    @if(count($menu->children))
                                        @include('admin.components.menu-table-item',['menu_childrens' => $menu->children])
                                    @endif
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