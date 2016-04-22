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
     * @var CrmService
     */
    private $crmService;

    /**
     * @internal param UserRepositoryInterface $userRepository
     */
    public function __construct(CrmService $crmService)
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');

        $this->crmService = $crmService;

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
        $users = null;
        $crm = $this->crm;

        if ($crm && $crm->is_active) {
            $users = $this->crmService->getUsers($crm->url);
        }

        return view('pages.crm.index')->with(compact('organization', 'crm', 'users'));

    }

    /**
     *
     * Activate CRM INSTANCE
     * @param CRM $CRM
     * @param $id
     */
    public function activateCRM(CrmService $CRM)
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
    public function checkAvailabilityCRM(CrmService $CRM)
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
    public function disableCRM(CrmService $CRM)
    {
        $response = $CRM->disable($this->crm->url);

        if ($response == true) {
            $this->crm->is_active = false;
            $this->crm->save();
            Flash::success(Lang::get('crm.disable-success'));
        } else {
            Flash::error(Lang::get('crm.disable-failed'));
        }

        return redirect(action('CrmController@index'));

    }

    /**
     * @param CrmService $CRM
     * @param $id
     * @return mixed
     */
    public function reactivateCRM(CrmService $CRM)
    {
        $response = $CRM->reactivate($this->crm->url);

        if ($response == true) {
            $this->crm->is_active = true;
            $this->crm->save();
            Flash::success(Lang::get('crm.reactivate-success'));
        } else {
            Flash::error(Lang::get('crm.reactivate-failed'));
        }

        return redirect(action('CrmController@index'));
    }

    /**
     * @param CrmService $CRM
     * @param UsersCrmRequest $request
     * @param $id
     * @return mixed
     */
    public function createUser(CrmService $CRM, UsersCrmRequest $request)
    {
        $response = $CRM->createUser($this->crm->url, $request->all());

        if ($response == true) {
            Flash::success(Lang::get('crm.createuser-success'));
        } else {
            Flash::error(Lang::get('crm.createuser-failed'));
        }

        return redirect(action('CrmController@index'));
    }

    /**
     * @param CrmService $CRM
     * @param $id
     * @param $id_user
     * @return mixed
     */
    public function toogleUserCRM(CrmService $CRM, $id_user)
    {
        $response = $CRM->toogleUserCRM($this->crm->url, $id_user);

        if ($response == true) {
            Flash::success(Lang::get('crm.tooglecrm-success'));
        } else {
            Flash::error(Lang::get('crm.tooglecrm-failed'));
        }

        return redirect(action('CrmController@index'));
    }


}
