<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->from('llvtbrvt@gmail.com', 'Lực Lượng Vũ Trang Bà Rịa - Vũng Tàu')
        ->subject('[www.lucluongvutrangbrvt.vn] Xác thực mã hai yếu tố của bạn.')
        ->greeting('Xin chào!')
        ->line('Mã hai yếu tố của bạn là: '.$notifiable->two_factor_code)
        ->action('Xác minh tại đây', route('verify.index'))
        ->line('Mã sẽ hết hạn sau 10 phút')
        ->line('Nếu bạn chưa cố gắng đăng nhập, hãy bỏ qua thông báo này.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
