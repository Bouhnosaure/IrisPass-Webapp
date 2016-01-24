<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsGroupRequest;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\Services\OsjsService;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsGroupsController extends Controller
{

    private $organization;
    private $osjsGroupRepository;

    /**
     * @param OsjsGroupRepositoryInterface $osjsGroupRepository
     */
    public function __construct(OsjsGroupRepositoryInterface $osjsGroupRepository)
    {
        $this->middleware('auth');

        $this->osjsGroupRepository = $osjsGroupRepository;
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
        return view('pages.osjs_groups.index')->with('groups', $this->organization->groups()->get());
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
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function store(OsjsGroupRequest $request, OsjsService $service)
    {
        $group = $this->osjsGroupRepository->create($request->all());

        if ($service->createGroupDirectory($group->name)) {

            $group->organization()->associate($this->organization);
            $group->save();

            Flash::success(Lang::get('osjs_groups.create-success'));
            return redirect(action('OsjsGroupsController@index'));
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
        $group = $this->osjsGroupRepository->getById($id);

        return view('pages.osjs_groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = $this->osjsGroupRepository->getById($id);

        return view('pages.osjs_groups.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OsjsGroupRequest $request, $id)
    {
        $this->osjsGroupRepository->update($id, $request->all());

        Flash::success(Lang::get('osjs_groups.update-success'));

        return redirect(action('OsjsGroupsController@show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // nothing now
    }
}
