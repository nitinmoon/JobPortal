<?php

namespace App\Mail;

use App\Models\Constants\UserRoleConstants;
use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SaveContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $name = '',
        $email = '',
        $message = '',
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: $this->email,
            subject: "New Contact Message",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $userData = User::where('role_id', UserRoleConstants::SUPER_ADMIN)->first();
        $userName = $userData['first_name'] . ' ' . $userData['last_name'];
        $msg = '<h3 style="text-align:center;"><b>New Contact Message</b></h3><br>';
        $msg .= '<p style="color:grey;">Following are the contact details:</p>';
        $msg .= '<p style="color:grey;"><strong>Name:</strong> ' . $this->name . '</p>';
        $msg .= '<p style="color:grey;"><strong>Email:</strong> ' . $this->email . '</p>';
        $msg .= '<p style="color:grey;"><strong>Message:</strong> ' . $this->message . '</p>';

        return new Content(
            markdown: 'emails.save-contact-email',
            with: [
                'msg' => $msg,
                'userName' => $userName
            ],
        );
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
