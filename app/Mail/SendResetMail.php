<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use URL;

class SendResetMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $user)
    {
        $this->email = $email;
        $this->user = $user;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'パスワードを再設定してください。',
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
            'users.pwEdit',
            now()->minutes(5),
            ['user', $this->user]
        )
         . '&email=' . $this->email
         . '&id=' . $this->user->id;
        return new Content(
            html: 'mails.resetMail',
            with: ['url' => $url]
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
