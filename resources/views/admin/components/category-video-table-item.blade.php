<?php $dash.='/----'; ?>
@foreach ($category_childrens as $category_children)
<?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>
            {{$dash}}<a href="{{ route('admin.category.video.edit', ['category' => $category_children->id]) }}" class="btn btn-info btn-xs">{{ $category_children->name }}</a>
        </td>
        <td>
            <img src="{{ isset($category_children->thumbnail) ? $category_children->thumbnail :  asset('assets/admin/images/70x70no-thumbnail.png')}}" class="img-responsive" {{ isset($category_children->thumbnail) ? 'width=50' : 'width=50' }}>                               
        </td>
        <td>
            @if ($category_children->getNextSibling())
                <a href="{{ route('admin.category.video.down' , ['category' => $category_children->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-arrow-down"></i></a>
            @endif
            @if ($category_children->getPrevSibling())
                <a href="{{ route('admin.category.video.up' , ['category' => $category_children->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-up"></i></a>
            @endif
        </td>
        <td>
            @if($category_children->isDisable())
                <a data-function="enable" data-method="put" href="{{ route('admin.category.video.enable' , ['category' => $category_children->id]) }}" class="btn btn-danger btn-xs">Ẩn</a>
            @endif
            @if($category_children->isEnable())
                <a data-function="disable" data-method="put" href="{{ route('admin.category.video.disable' , ['category' => $category_children->id]) }}"  class="btn btn-success btn-xs">Hiện</a>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.category.video.edit', ['category' => $category_children->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>

            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".confirm-delete-category-{{ $category_children->id }}"><i class="fa fa-trash-o"></i> Xoá </button>

            <div class="modal fade confirm-delete-category-{{ $category_children->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title">Bạn có chắc muốn xoá?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                      <a data-function="destroy" data-method="delete" href="{{ route('admin.category.video.destroy', ['category' => $category_children->id]) }}" class="btn btn-danger">Xoá</a>
                    </div>

                  </div>
                </div>
              </div>
        </td>
    </tr>
    @if(count($category_children->children))
        @include('admin.components.category-video-table-item',['category_childrens' => $category_children->children])
    @endif
@endforeach