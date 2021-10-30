<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $mail)
    {
        //
        $this->name = $name;
        $this->email = $mail;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->to('yanoryo7032@gmail.com')  
                ->subject('登録完了しました。')
                ->view('send_mail')
                ->with(['name' => $this->name]);
    }
}
