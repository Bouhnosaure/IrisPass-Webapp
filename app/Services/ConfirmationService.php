<?php namespace App\Services;

use App\Jobs\SendConfirmationCodeMail;
use App\Jobs\SendConfirmationCodePhone;
use App\Repositories\UserConfirmationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class ConfirmationService
{
    use DispatchesJobs;

    /**
     * @var data return
     */
    private $data = [];

    /**
     * @var UserConfirmationRepositoryInterface
     */
    private $confirmationRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param UserConfirmationRepositoryInterface $confirmationRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserConfirmationRepositoryInterface $confirmationRepository, UserRepositoryInterface $userRepository)
    {
        $this->confirmationRepository = $confirmationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * handles creation process for carpooling
     *
     * @param User $user
     * @param $type
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function send(User $user, $type)
    {
        $this->confirmationRepository->clear($user, $type);

        if ($type == "mail" && Config::get('confirmation.mail')) {
            $code = $this->confirmationRepository->create($user, $type);
            $this->dispatch(new SendConfirmationCodeMail($user, $code));
            $this->dataReturn('send-mail-success');

            return $this->data;
        }

        if ($type == "phone" && Config::get('confirmation.phone') && isset(Auth::user()->profile->phone)) {
            $code = $this->confirmationRepository->create($user, $type);
            $this->dispatch(new SendConfirmationCodePhone($user, $code));
            $this->dataReturn('send-phone-success');

            return $this->data;
        }

        $this->dataReturn('send-failed');

        return $this->data;
    }

    /**
     *
     * Handles the validation process of an user
     *
     * @param User $user
     * @param $type
     * @param $code
     * @return data
     */
    public function validate(User $user, $type, $code)
    {

        //Existence
        $code = $this->confirmationRepository->getByConfirmationCode($code);
        if ($code == null) {
            switch ($type) {
                case 'mail':
                    $this->dataReturn('not-found-mail');
                    break;
                case 'phone':
                    $this->dataReturn('not-found-phone');
                    break;
            }

            return $this->data;
        }

        //Tests
        $user_test = $code->user_id == $user->id;
        $type_test = $code->type == $type;
        $expiration_test = Carbon::parse($code->created_at)->addHour(2)->isPast();

        //Actions
        if ($expiration_test) {
            $this->dataReturn('expired');
        } else {
            if ($user_test && $type_test) {
                $this->userRepository->update($user->id, ["profile" => ["{$type}_confirmed" => true]]);
                $this->dataReturn('success');
            } else {
                $this->userRepository->update($user->id, ["profile" => ["{$type}_confirmed" => false]]);
                $this->dataReturn('failed');
            }
        }

        $this->confirmationRepository->clear($user, $type);

        return $this->data;
    }


    public function dataReturn($code)
    {
        switch ($code) {
            case 'expired':
                $this->data['flash_type'] = 'error';
                $this->data['flash_message'] = Lang::get('confirmation.failed-expiration');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;
            case 'not-found-mail':
                $this->data['flash_type'] = 'error';
                $this->data['flash_message'] = Lang::get('confirmation.failed-not-found');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;
            case 'not-found-phone':
                $this->data['flash_type'] = 'error';
                $this->data['flash_message'] = Lang::get('confirmation.failed-not-found');
                $this->data['redirect'] = action('Auth\ConfirmationController@submitPhoneCode');
                break;
            case 'failed':
                $this->data['flash_type'] = 'error';
                $this->data['flash_message'] = Lang::get('confirmation.failed');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;
            case 'success':
                $this->data['flash_type'] = 'success';
                $this->data['flash_message'] = Lang::get('confirmation.success');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;
            case 'send-mail-success':
                $this->data['flash_type'] = 'success';
                $this->data['flash_message'] = Lang::get('confirmation.send-mail-success');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;
            case 'send-phone-success':
                $this->data['flash_type'] = 'success';
                $this->data['flash_message'] = Lang::get('confirmation.send-phone-success');
                $this->data['redirect'] = action('Auth\ConfirmationController@submitPhoneCode');
                break;
            case 'send-failed':
                $this->data['flash_type'] = 'error';
                $this->data['flash_message'] = Lang::get('confirmation.send-failed');
                $this->data['redirect'] = action('Auth\ConfirmationController@index');
                break;

        }
    }
}
