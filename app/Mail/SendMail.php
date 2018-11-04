<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $template;
    public $params;
    public $attachmentsFile;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $template
     * @param array $params
     * @param $attachments
     * @return void
     */
    public function __construct(string $subject, string $template, array $params = [], $attachments = [])
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->params = $params;
        $this->attachmentsFile = $attachments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this
            ->subject($this->subject)
            ->view($this->template);

        foreach ($this->attachmentsFile as $attachment) {
            $email->attach($attachment->getPath());
        }

        return $email;
    }
}
