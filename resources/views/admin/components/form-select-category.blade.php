@php 
	if (!isset($level)) {
		$level = 0;
		$parent_id = null;
	}
@endphp

@if($level == 0)
	<select name="{{ $name }}" class="form-control">
		<option value=""></option>
		@foreach($categories as $category_item)
			@php $has_child = $categories->where('parent_id', $category_item->id)->first(); @endphp
			@if($category_item->parent_id == $parent_id)

				@if (isset($category_id))
					@if ($category_item->id == $category_id)
					
					@else
						<option {{ isset($selected) && $selected == $category_item->id ? 'selected' : '' }} value="{{ $category_item->id }}">{{ $category_item->name }}</option>
					@endif
				@else
					<option {{ isset($selected) && $selected == $category_item->id ? 'selected' : '' }} value="{{ $category_item->id }}">{{ $category_item->name }}</option>
				@endif

                
                @if($has_child)
					@include('admin.components.form-select-category', [
						'categories' => $categories,
						'name' => $name,
						'selected' => isset($selected) ? $selected : '',
						'parent_id' => $category_item->id,
						'level' => $level + 1
					])
				@endif
			@endif
		@endforeach
	</select>
@else
	@foreach($categories as $category_item)
		@php $has_child = $categories->where('parent_id', $category_item->id)->first(); @endphp
		@if($category_item->parent_id == $parent_id)		
			<option {{ isset($selected) && $selected == $category_item->id ? 'selected' : '' }} value="{{ $category_item->id }}">{{ str_repeat('/----', $level) . $category_item->name }}</option>
			@if($has_child)
				@include('admin.components.form-select-category', [
					'categories' => $categories,
					'name' => $name,
					'selected' => isset($selected) ? $selected : '',
					'parent_id' => $category_item->id,
					'level' => $level + 1
				])
			@endif
		@endif
	@endforeach
@endif