<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerEmail extends Mailable
{
    use Queueable, SerializesModels;

    

    public function __construct()
    {
        
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Customer Email',
        );
    }

    public function build(){
        
        return $this->subject("The code verify")
                    ->view('front-end.auth.email-verify')
                    ->with([
                        'code' => '123456'
                    ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
