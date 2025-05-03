<?php

namespace App\Mail;

use App\Models\Constants\UserRoleConstants;
use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;
    public $password;
    public $userType;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $userData = [],
        $password = '',
    ) {
        $this->userData = $userData;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS'),
            subject: "New Account - " . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $userData = $this->userData;
        $password = $this->password;
        $userRole = Role::where('id', $userData['role_id'])->first();
        $userName = $userData['first_name'] . ' ' . $userData['last_name'];
        $userRoleName = $userRole['id'] == UserRoleConstants::EMPLOYER ? 'Employer' : 'Candidate';
        $msg = '<p style="text-align:center;"><b>Your account has been successfully created as '. $userRoleName .' in ' . config('app.name') . '.</b></p><br>';
        $msg .= '<p style="color:grey;">Following are your login credentails<br>';
        $msg .= '<p style="color:grey;"><i>Name - ' . $userName . '</i></p>';
        $msg .= '<p style="color:grey;"><i>Email - ' . $userData['email'] . '</i></p>';
        $msg .= '<p style="color:grey;"><i>Password - ' . $password . '</i></p>';
        $msg .= 'Please Login with above login details</p><br>';
        if ($userRole['id'] == UserRoleConstants::EMPLOYER) {
            $msg .= '<a href="' . route('employerLogin') . '" style="text-decoration:none; color:#2899d8;">Login</a><br><br>';
        } else {
            $msg .= '<a href="' . route('candidateLogin') . '" style="text-decoration:none; color:#2899d8;">Login</a><br><br>';
        }

        return new Content(
            markdown: 'emails.add-user-email',
            with: [
                'msg' => $msg,
                'user' => $userName
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
