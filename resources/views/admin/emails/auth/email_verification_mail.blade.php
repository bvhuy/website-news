@component('mail::message')

Xin chào {{$user->admin_name}}, 
@component('mail::button', ['url' => route('verify_email', $user->email_verification_code)])
Bấm vào đây để xác minh địa chỉ email của bạn
@endcomponent

<p>Hoặc sao chép, dán liên kết sau vào trình duyệt web của bạn để xác minh địa chỉ email của bạn.</p>

<p><a href="{{route('verify_email', $user->email_verification_code)}}">{{route('verify_email', $user->email_verification_code)}}</a></p>

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
