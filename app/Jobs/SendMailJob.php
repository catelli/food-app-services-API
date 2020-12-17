<?php

namespace App\Jobs;

use App\Mail\SendMail;

class SendMailJob extends Job
{

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        SendMail::sendEmail($this->data);
    }
}
