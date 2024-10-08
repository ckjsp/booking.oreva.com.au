<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Hello from Laravel')
                    ->view('emails.hello');
    }
}
