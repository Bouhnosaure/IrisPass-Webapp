<?php namespace App\Jobs;

use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConfirmationCodeMail extends Job implements ShouldQueue, SelfHandling
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var
     */
    private $code;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param $code
     */
    public function __construct(User $user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        //for clojure access variable
        $_user = $this->user;

        Mail::send('emails.confirmation-code', ['user' => $_user, 'code' => $this->code], function ($message) use ($_user) {
            $message->to($_user->email, $_user->name);
            $message->subject('Confirmation Code');
        });
    }
}
