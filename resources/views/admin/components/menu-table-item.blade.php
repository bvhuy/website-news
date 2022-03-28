<?php $dash.='/----'; ?>
@foreach ($menu_childrens as $menu_children)
<?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>
            {{$dash}}<a href="{{ route('admin.menu.edit', ['menu' => $menu_children->id]) }}" class="btn btn-info btn-xs">{{ $menu_children->name }}</a>
        </td>
        <td>
            @if ($menu_children->getNextSibling())
                <a href="{{ route('admin.menu.down' , ['menu' => $menu_children->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-arrow-down"></i></a>
            @endif
            @if ($menu_children->getPrevSibling())
                <a href="{{ route('admin.menu.up' , ['menu' => $menu_children->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-up"></i></a>
            @endif
        </td>
        <td>
            @if($menu_children->isDisable())
                <a data-function="enable" data-method="put" data-function="enable" data-method="put" href="{{ route('admin.menu.enable' , ['menu' => $menu_children->id]) }}" class="btn btn-danger btn-xs">Ẩn</a>
            @endif
            @if($menu_children->isEnable())
                <a data-function="disable" data-method="put" data-function="disable" data-method="put" href="{{ route('admin.menu.disable' , ['menu' => $menu_children->id]) }}"  class="btn btn-success btn-xs">Hiện</a>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.menu.edit', ['menu' => $menu_children->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>

            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-{{ $menu_children->id }}"><i class="fa fa-trash-o"></i> Xoá </button>

            <div class="modal fade confirm-delete-{{ $menu_children->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                      <a data-function="destroy" data-method="delete" href="{{ route('admin.menu.destroy', ['menu' => $menu_children->id]) }}" class="btn btn-danger">Xoá</a>
                    </div>

                  </div>
                </div>
              </div>
        </td>
    </tr>
    @if(count($menu_children->children))
        @include('admin.components.menu-table-item',['menu_childrens' => $menu_children->children])
    @endif
@endforeach