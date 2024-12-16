<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Mail;
use App\Models\User;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $verifyUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $verifyUrl)
{
    $this->user = $user;
    $this->verifyUrl = $verifyUrl;
}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registered account',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register_account',
            with: ['user' => $this->user],  // Truyền dữ liệu user vào view
        );
    }
    public function build()
    {
        return $this->view('emails.RegisteredMail')
                    ->with([
                        'user' => $this->user,
                        'verifyUrl' => $this->verifyUrl, // Chuyển verify URL cho email
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
