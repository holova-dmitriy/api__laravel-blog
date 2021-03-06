<?php

namespace App\Jobs;

use Mail;
use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subject;
    public $template;
    public $to;
    public $params;
    public $attachments;

    /**
     * Create a new job instance.
     *
     * @param string $subject
     * @param string $template
     * @param $to
     * @param array $params
     * @param $attachments
     * @return void
     */
    public function __construct(string $subject, string $template, $to, array $params = [], $attachments = [])
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->to = $to;
        $this->params = $params;
        $this->attachments = $attachments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new SendMail($this->subject, $this->template, $this->params, $this->attachments));
    }
}
