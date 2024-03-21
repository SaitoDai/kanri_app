<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Http\Request;
use App\Models\User;
use URL;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    // $this に email プロパティを追加する
    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email) //UserController 150行目 に入れた sendEmail($email) をここで受ける。
    {   
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    { 
        return new Envelope(
            subject: '【管理アプリ】ユーザー登録を進めてください。',
            from: new Address('kanri@example.com', '管理アプリ'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {   
        $url = URL::temporarySignedRoute(
			'users.create',  // ルーティング名
			now()->addMinutes(5)   // 有効期限
			/*['user_id' => 1] */       // パラメータ(今回はNULL)
		) . '&email=' . $this->email;
        
        return new Content(
            html: 'mails.applyMail',
            with: ['url' => $url,
                   'email' => $this->email],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
