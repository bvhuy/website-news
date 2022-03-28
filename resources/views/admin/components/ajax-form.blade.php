@php 
	if (isset($params['class'])) {
		if (! str_contains($params['class'], 'ajax-form')) {
			$params['class'] .= ' ajax-form';
		}
	} else {
		$params['class'] = 'ajax-form';
	}
@endphp

{!! Form::open($params) !!}