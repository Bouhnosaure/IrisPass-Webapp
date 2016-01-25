<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsGroupRequest;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\Services\OsjsService;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsUserGroupsController extends Controller
{

    private $organization;

    public function __construct()
    {
        $this->middleware('auth');

        $this->organization = Auth::user()->organization()->first();

        if ($this->organization == null) {
            Flash::error(Lang::get('organization.fail-not-exist'));
            return redirect(action('OrganizationController@index'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = $this->organization->groups()->get();
        $users = $this->organization->users()->get();
        return view('pages.manage_osjs_groups.index')->with(compact('group', 'users'));
    }

    /**
     * addUserToGroup
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\Response
     */
    public function addUserToGroup($userId, $groupId)
    {
        return view('pages.osjs_groups.create');
    }

    /**
     * Remove user from group
     *
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\Response
     */
    public function removeUserFromGroup($userId, $groupId)
    {

    }


}
