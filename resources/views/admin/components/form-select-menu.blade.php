@php 
	if (!isset($level)) {
		$level = 0;
		$parent_id = null;
	}
@endphp

@if($level == 0)
	<select name="{{ $name }}" class="form-control">
		<option value=""></option>
		@foreach($menus as $menu_item)
			@php $has_child = $menus->where('parent_id', $menu_item->id)->first(); @endphp
			@if($menu_item->parent_id == $parent_id)

				@if (isset($menu_id))
					@if ($menu_item->id == $menu_id)
					
					@else
						<option {{ isset($selected) && $selected == $menu_item->id ? 'selected' : '' }} value="{{ $menu_item->id }}">{{ $menu_item->name }}</option>
					@endif
				@else
					<option {{ isset($selected) && $selected == $menu_item->id ? 'selected' : '' }} value="{{ $menu_item->id }}">{{ $menu_item->name }}</option>
				@endif

                
                @if($has_child)
					@include('admin.components.form-select-menu', [
						'menus' => $menus,
						'name' => $name,
						'selected' => isset($selected) ? $selected : '',
						'parent_id' => $menu_item->id,
						'level' => $level + 1
					])
				@endif
			@endif
		@endforeach
	</select>
@else
	@foreach($menus as $menu_item)
		@php $has_child = $menus->where('parent_id', $menu_item->id)->first(); @endphp
		@if($menu_item->parent_id == $parent_id)		
			<option {{ isset($selected) && $selected == $menu_item->id ? 'selected' : '' }} value="{{ $menu_item->id }}">{{ str_repeat('/----', $level) . $menu_item->name }}</option>
			@if($has_child)
				@include('admin.components.form-select-menu', [
					'menus' => $menus,
					'name' => $name,
					'selected' => isset($selected) ? $selected : '',
					'parent_id' => $menu_item->id,
					'level' => $level + 1
				])
			@endif
		@endif
	@endforeach
@endif