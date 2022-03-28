@php 
    if (!isset($level)) {
        $level = 0;
        $parent_id = null;
    }
@endphp

@if($level == 0)
    <div class="input-group" style="margin: 5px 0;">
        <div class="icheck-list">
@endif
            @foreach($items as $item_item)
                @php $has_child = $items->where('parent_id', $item_item->id)->first(); @endphp
                @if($item_item->parent_id == $parent_id)        
                    <label>
                        {{ str_repeat(html_entity_decode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'), $level) }}<input type="checkbox" name="{{ $name }}" value="{{ $item_item->id }}" class="icheck" data-checkbox="icheckbox_square-grey"> {{ $item_item->menu_title }}
                    </label>
                    @if($has_child)
                        <div id="checkbox-item-{{ $item_item->id }}" class="collapse " style="margin-bottom: 8px">
                            <div class="icheck-list">
                                @include('admin.components.form-checkbox-menu-item', [
                                    'items' => $items,
                                    'name' => $name,
                                    'parent_id' => $item_item->id,
                                    'level' => $level + 1,
                                ])
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach

@if($level == 0)
        </div>
    </div>
@endif

@if($level == 0)
    @section('css')
        {{-- <link href="{{ asset('assets/admin/global/plugins/uniform/css/uniform.default.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/admin/global/css/components-md.min.css') }}" rel="stylesheet" /> --}}
        <link href="{{ asset('assets/admin/global/css/plugins-md.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/admin/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" />
    @endsection
    
    @section('js')
    <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery.blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/admin/global/scripts/app.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/admin/global/scripts/handle.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/icheck/icheck.min.js')}} "></script>
    <script type="text/javascript">
        $(function(){
            $('input[name="{{ $name }}"]').on('ifChanged', function () {
                var id = $(this).val();
                if (this.checked) {
                    $('#checkbox-item-'+id).collapse('show');
                } else {
                    $('#checkbox-item-'+id).collapse('hide');
                    $('#checkbox-item-'+id +' input[type="checkbox"]').iCheck('uncheck');
                }
            });
        });
    </script>
    @endsection
@endif