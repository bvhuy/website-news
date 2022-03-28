@php 
    if (!isset($level)) {
        $level = 0;
        $parent_id = null;
    }
@endphp

@if($level == 0)
    <div class="well">
        <div class="input-group">
            <div class="icheck-list" id="list-categories">
@endif
        @foreach($categories as $category_item)
            @php $has_child = $categories->where('parent_id', $category_item->id)->first(); @endphp
            @php $active = in_array($category_item->id, $checked); @endphp
            @if($category_item->parent_id == $parent_id)        
                <label>
                    {{ str_repeat(html_entity_decode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'), $level) }}<input {{ $active ? 'checked' : '' }} type="checkbox" name="{{ $name }}" value="{{ $category_item->id }}" class="icheck" data-checkbox="icheckbox_square-grey"> {{ $category_item->name }}
                </label>
                @if($has_child)
                    <div id="checkbox-category-{{ $category_item->id }}" class="collapse {{ $active ? 'in' : '' }}"  style="margin-bottom: 8px">
                        <div class="icheck-list">
                            @include('admin.components.form-checkbox-category', [
                                'categories' => $categories,
                                'name' => $name,
                                'parent_id' => $category_item->id,
                                'level' => $level + 1,
                                'checked' => $checked,
                            ])
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

@if($level == 0)
            </div>
        </div>
    </div>
@endif

@if($level == 0)
    @section('js1')
        <script>
            $('input[name="{{ $name }}"]').on('ifChanged', function () {
                var id = $(this).val();
                if (this.checked) {
                    $('#checkbox-category-'+id).collapse('show');
                } else {
                    $('#checkbox-category-'+id).collapse('hide');
                    $('#checkbox-category-'+id +' input[type="checkbox"]').iCheck('uncheck');
                }
            });
        </script>
    @endsection
@endif