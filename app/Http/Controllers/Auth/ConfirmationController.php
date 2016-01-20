<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 09/05/2015
 * Time: 23:05
 */

namespace App\Http\Controllers\Auth;

use App\Commands\SendConfirmationCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmationRequest;
use App\Repositories\UserConfirmationRepositoryInterface;
use App\Services\ConfirmationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * displays the list of the user confirmations
     * @return $this
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.confirmation.index')->with('user', $user);
    }

    /**
     * handles the sending of the differents types of confirmations
     * @param $type
     * @param ConfirmationService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send($type, ConfirmationService $service)
    {
        $data = $service->send(Auth::user(), $type);
        Flash::$data['flash_type'](Lang::get($data['flash_message']));
        return redirect($data['redirect']);
    }

    /**
     * shows the form for enter the 4 digit code for the phone
     */
    public function submitPhoneCode()
    {
        return view('pages.confirmation.phone-confirmation');
    }

    /**
     * handle post method for the 4 digit code confirmation for the phone
     * @param ConfirmationRequest $request
     * @param ConfirmationService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handlePhoneCode(ConfirmationRequest $request, ConfirmationService $service)
    {
        $data = $service->validate(Auth::user(), 'phone', $request->get('code'));
        Flash::$data['flash_type'](Lang::get($data['flash_message']));
        return redirect($data['redirect']);
    }

    /**
     * Receive the token for authorize an user
     * @param $code
     * @param ConfirmationService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmMailCode($code, ConfirmationService $service)
    {
        $data = $service->validate(Auth::user(), 'mail', $code);
        Flash::$data['flash_type'](Lang::get($data['flash_message']));
        return redirect($data['redirect']);
    }
}
