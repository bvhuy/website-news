<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('llvtbrvt@gmail.com', 'Lực Lượng Vũ Trang Bà Rịa - Vũng Tàu')
        ->subject('[www.lucluongvutrangbrvt.vn] Xác thực Email của bạn.')
        ->markdown('admin.emails.auth.email_verification_mail')
        ->with([
            'user' => $this->user
        ]);
    }
}
