@extends('admin.layouts')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý danh mục video</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.category.video.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
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
                                    <th>Tên danh mục</th>
                                    <th style="width: 20%">Thumbnail</th>
                                    <th>Sắp xếp</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($categories as $category)
                                <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                            
                                <?php $dash=''; ?>
                                    <tr>
                                        <td>{{$_SESSION['i']}}</td>
                                        <td>
                                            <a href="{{ route('admin.category.video.edit', ['category' => $category->id]) }}" class="btn btn-info btn-xs">{{ $category->name }}</a>
                                        </td>
                                        <td>
                                            <img src="{{ isset($category->thumbnail) ? $category->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" {{ isset($category->thumbnail) ? 'width=50' : 'width=50' }}>                               
                                        </td>
                                        <td>
                                            @if ($category->getNextSibling())
                                                <a href="{{ route('admin.category.video.down' , ['category' => $category->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-arrow-down"></i></a>
                                            @endif
                                            @if ($category->getPrevSibling())
                                                <a href="{{ route('admin.category.video.up' , ['category' => $category->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-up"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->isDisable())
                                                <a data-function="enable" data-method="put" href="{{ route('admin.category.video.enable' , ['category' => $category->id]) }}" class="btn btn-danger btn-xs">Ẩn</a>
                                            @endif
                                            @if($category->isEnable())
                                                <a data-function="disable" data-method="put" href="{{ route('admin.category.video.disable' , ['category' => $category->id]) }}" class="btn btn-success btn-xs">Hiện</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.video.edit', ['category' => $category->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>
    
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-category-{{ $category->id }}"><i class="fa fa-trash-o"></i> Xoá </button>
    
                                            <div class="modal fade confirm-delete-category-{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                  <div class="modal-content">
                            
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                      </button>
                                                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                      <a data-function="destroy" data-method="delete" href="{{ route('admin.category.video.destroy', ['category' => $category->id]) }}" class="btn btn-danger">Xoá</a>
                                                    </div>
                            
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                    @if(count($category->children))
                                        @include('admin.components.category-video-table-item',['category_childrens' => $category->children])
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