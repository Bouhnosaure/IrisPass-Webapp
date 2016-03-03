<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsGroupRequest;
use App\OsjsGroup;
use App\Services\OsjsService;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsGroupsController extends Controller
{

    private $organization;


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');
        $this->organization = Auth::user()->organization()->first();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.osjs_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OsjsGroupRequest $request
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function store(OsjsGroupRequest $request, OsjsService $service)
    {
        $group = OsjsGroup::create($request->all());
        $name = $this->organization->uuid . "-" . $group->name;

        if ($path = $service->createDirectory('group', $name)) {

            $group->organization_uuid = $this->organization->uuid;
            $group->realname = $name;
            $group->path = $path;
            $group->organization()->associate($this->organization);
            $group->save();

            Flash::success(Lang::get('osjs_groups.create-success'));
            return redirect(action('VirtualDesktopController@index') . '#orgagroups');
        } else {
            Flash::error(Lang::get('osjs_groups.create-failed'));
            return redirect(action('OsjsGroupsController@create'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = OsjsGroup::findOrFail($id);
        $users = $this->organization->users()->get();

        return view('pages.osjs_groups.show')->with(compact('group', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = OsjsGroup::findOrFail($id);

        return view('pages.osjs_groups.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OsjsGroupRequest $request
     * @param  int $id
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function update(OsjsGroupRequest $request, $id, OsjsService $service)
    {
        //get the old version
        $group_old = OsjsGroup::findOrFail($id);
        $old_name = $this->organization->uuid . "-" . $group_old->name;

        //update
        $group = OsjsGroup::findOrFail($id);
        $group->update($request->all());
        $group->save();

        //get the new version
        $name = $this->organization->uuid . "-" . $group->name;

        if ($path = $service->renameDirectory('group', $old_name, $name)) {

            $group->organization_uuid = $this->organization->uuid;
            $group->realname = $name;
            $group->path = $path;
            $group->save();

            Flash::success(Lang::get('osjs_groups.update-success'));
        } else {
            Flash::error(Lang::get('osjs_groups.update-failed'));
        }

        return redirect(action('OsjsGroupsController@show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, OsjsService $service)
    {
        $group = OsjsGroup::findOrFail($id);

        $name = $this->organization->uuid . "-" . $group->name;

        if ($path = $service->deleteDirectory('group', $name)) {

            $group->delete();

            Flash::success(Lang::get('osjs_groups.destroy-success'));
        } else {
            Flash::error(Lang::get('osjs_groups.destroy-failed'));
        }

        return redirect(action('VirtualDesktopController@index') . '#orgagroups');
    }


}
