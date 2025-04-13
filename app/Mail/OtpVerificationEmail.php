<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;
    public $otp;
    public $bladeName;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $subject = '',
        $msg = '',
        $otp = '',
        $bladeName = ''
    ) {
        $this->subject = $subject;
        $this->msg = $msg;
        $this->otp = $otp;
        $this->bladeName = $bladeName;
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: $this->subject,
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: $this->bladeName,
    //         with: [
    //             'msg' => $this->msg,
    //             'otp' => $this->otp
    //         ]
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from(env('MAIL_FROM_ADDRESS'), config('app.name', 'Laravel'))
            ->markdown($this->bladeName)
            ->subject($this->subject)
            ->with([
                'msg' => $this->msg,
                'otp' => $this->otp
            ]);
    }
}
