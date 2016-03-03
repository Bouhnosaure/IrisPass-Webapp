<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersCrmRequest;
use App\Crm;
use App\Services\CrmService;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class CrmController extends Controller
{
    use DispatchesJobs;

    private $organization;

    /**
     * @internal param UserRepositoryInterface $userRepository
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');

        $this->organization = Auth::user()->organization()->first();
        $this->crm = $this->organization->crm()->first();

        Carbon::setLocale('fr');

    }

    /**
     * Show the desktops
     *
     * @return Response
     */
    public function index()
    {

        $organization = $this->organization;

        $crm = $this->crm;

        return view('pages.crm.index')->with(compact('organization', 'crm'));

    }

    /**
     *
     * Activate CRM INSTANCE
     * @param CRM $CRM
     * @param $id
     */
    public function activateCRM(CrmService $CRM, $id)
    {
        $identifier = str_slug($this->organization->name, "-");

        $response = $CRM->process($identifier);

        if ($response == true) {
            $crm = new Crm();
            $crm->identifier = $identifier;
            $crm->is_active = true;
            $crm->url = $identifier;
            $crm->save();

            $crm->organization()->associate($this->organization);
            $crm->save();

            Flash::success(Lang::get('crm.create-success'));
        } else {
            Flash::error(Lang::get('crm.create-failed'));
        }

        return redirect(action('CrmController@index'));
    }

    /**
     * PING URL
     * @param CrmService $CRM
     * @param $id
     */
    public function checkAvailabilityCRM(CrmService $CRM, $id)
    {
        $response = $CRM->isActive($this->crm->url);
        $identifier = $this->crm->url;
        return $this->response->array(compact('response', 'identifier'));
    }

    /**
     * DISABLE BY MOVING INTO Directory
     * @param CrmService $CRM
     * @param $id
     */
    public function disableCRM(CrmService $CRM, $id)
    {
        $response = $CRM->disable($this->crm->url);
        return $this->response->array(compact('response'));
    }

    /**
     * @param CrmService $CRM
     * @param $id
     * @return mixed
     */
    public function reactivateCRM(CrmService $CRM, $id)
    {
        $response = $CRM->reactivate($this->crm->url);
        return $this->response->array(compact('response'));
    }

    /**
     * @param CrmService $CRM
     * @param UsersCrmRequest $request
     * @param $id
     * @return mixed
     */
    public function createUser(CrmService $CRM, UsersCrmRequest $request, $id)
    {
        $response = $CRM->createUser($this->crm->url, $request->all());
        return $this->response->array(compact('response'));
    }

    /**
     * @param CrmService $CRM
     * @param $id
     * @return mixed
     */
    public function getUsersCRM(CrmService $CRM, $id)
    {
        $users = $CRM->getUsers($this->crm->url);
        return $this->response->array(compact('users'));
    }

    /**
     * @param CrmService $CRM
     * @param $id
     * @param $id_user
     * @return mixed
     */
    public function toogleUserCRM(CrmService $CRM, $id, $id_user)
    {
        $response = $CRM->toogleUserCRM($this->crm->url, $id_user);
        return $this->response->array(compact('response'));
    }


}
