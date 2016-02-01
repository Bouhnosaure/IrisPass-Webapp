<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\OsjsGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsUserGroupsController extends Controller
{

    private $organization;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');

        $this->organization = Auth::user()->organization()->first();

    }

    /**
     * Display a listing of the groups of the organization
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->organization->groups()->get();
        $users = $this->organization->users()->get();
        return view('pages.osjs_users_groups.index')->with(compact('groups', 'users'));
    }

    /**
     * Add an user to a specified group
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\Response
     */
    public function addUserToGroup($groupId, $userId)
    {

        $group = OsjsGroup::find($groupId);
        $group->users()->attach($userId);

        Flash::success(Lang::get('osjs_users_groups.update-success'));

        return redirect(action('OsjsUserGroupsController@index'));

    }

    /**
     * Remove user from a specified group
     *
     * @param $userId
     * @param $groupId
     * @return \Illuminate\Http\Response
     */
    public function removeUserFromGroup($groupId, $userId)
    {
        $group = OsjsGroup::find($groupId);
        $group->users()->detach($userId);

        Flash::success(Lang::get('osjs_users_groups.update-success'));

        return redirect(action('OsjsUserGroupsController@index'));

    }


}
