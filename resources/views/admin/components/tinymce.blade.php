<textarea name="{{ $name or '' }}" class="form-control col-md-7 col-xs-12 texteditor {{ $params['class'] or '' }}">{!! $content or '' !!}</textarea>

{{-- <textarea name="news[content]" id="content" class="form-control col-md-7 col-xs-12">{{ $news->content }}</textarea> --}}
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
    <script type="text/javascript" src="{{ asset('assets/admin/global/scripts/handle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/icheck/icheck.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('assets/admin/global/plugins/tinymce/tinymce.min.js')}} "></script>
@endsection