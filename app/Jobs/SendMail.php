<?php

namespace App\Jobs;
use App\Models\Users;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Mail\Mailer;
class SendMail extends Job implements SelfHandling
{


    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
      $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
      $data = [
        'title'  => trans('front/verify.email-title'),
        'intro'  => trans('front/verify.email-intro'),
        'link'   => trans('front/verify.email-link'),
        'confirmation_code' => $this->user->confirmation_code
      ];

      $mailer->send('emails.auth.verify',$data,function($message){
        $message->to($this->user->email, $this->user->username)
                ->subject(trans('front/verify.email-title'));
      });
    }
}
