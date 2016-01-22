<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsUserRequest;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\Repositories\OsjsUserRepositoryInterface;
use App\Services\OsjsService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsGroupsController extends Controller
{

    private $organization;
    private $osjsGroupRepository;

    /**
     * @internal param UserRepositoryInterface $userRepository
     * @param OsjsUserRepositoryInterface $osjsUserRepository
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
        return view('pages.osjs_groups.index')->with('groups', $this->organization->users()->get());
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
     * @param OsjsUserRequest|Request $request
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function store(OsjsUserRequest $request, OsjsService $service)
    {
        $group = $this->osjsUserRepository->create($request->all());

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
        $user = $this->osjsUserRepository->getById($id);

        return view('pages.osjs_groups.show')->with('group', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->osjsUserRepository->getById($id);

        return view('pages.osjs_groups.edit')->with('group', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->osjsUserRepository->update($id, $request->all());

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
