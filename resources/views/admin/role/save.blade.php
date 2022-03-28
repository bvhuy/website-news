@extends('admin.layouts')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/global/css/plugins-md.min.css') }}" /> 
<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/icheck/skins/all.css') }}" />
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Quản lý người dùng</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('admin.role.index') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{  isset($role_id) ? trans('role.edit-role') : trans('role.add-new-role') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::ajax([
                        'url' => isset($role_id) ? route('admin.role.update', ['role' => $role->id]) : route('admin.role.store'),
                        'class' => 'form-horizontal form-label-left form-bordered form-row-stripped',
                        'method' => isset($role_id) ? 'PUT' : 'POST'
                    ]) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('role.name') <span class="text-danger required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{ $role->name }}" name="role[name]" type="text" id="name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>     
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('role.type') <span class="text-danger required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::select('role[type]', $role->typeable()->mapWithKeys(function ($item) {
                                return [$item['id'] => $item['name']];
                            })->all(), isset($role_id) ? $role->type : '*', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="permission-list" style="{{ isset($role_id) && $role->type == 'option' ? '' : 'display: none' }}">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="border-green">
                                    <?php $access_controls = collect(\AccessControl::all()); ?>
                                    @foreach($access_controls->chunk(3) as $chunks)
                                        <div class="row">
                                            @foreach($chunks->where('ability' ,'!=', 'admin.role.manage')->where('ability' ,'!=','admin.user.manage') as $access_item)
                                                <?php $check = isset($role_id) && in_array($access_item['ability'], (array) \AccessControl::getRole($role->id)['permissions']) ? 'checked' : '' ; ?>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                                <input {{ $check }} type="checkbox" class="icheck" name="role[permission][]" value="{{ $access_item['ability'] }}" /> {{ $access_item['name'] }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>				
                    </div>
                    <div class="ln_solid"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                
                        @if(! isset($role_id))
                            {!! Form::btnSaveNew() !!}
                        @else
                            {!! Form::btnSaveOut() !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/icheck/icheck.min.js')}} "></script>
<script type="text/javascript">
    $(function(){
		$('*[name="role[type]"]').change(function(){
			var roleType = $(this).val();
			switch(roleType) {
				case '*': case '0':
					$('.permission-list').hide();
				break;
				case 'option':
					$('.permission-list').show();
				break;
			}
		});
	});
</script>
@endsection