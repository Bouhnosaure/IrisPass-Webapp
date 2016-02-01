<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsUserRequest;
use App\Repositories\OsjsUserRepositoryInterface;
use App\Services\OsjsService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsUsersController extends Controller
{

    private $organization;
    private $osjsUserRepository;

    /**
     * @internal param UserRepositoryInterface $userRepository
     * @param OsjsUserRepositoryInterface $osjsUserRepository
     */
    public function __construct(OsjsUserRepositoryInterface $osjsUserRepository)
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');

        $this->osjsUserRepository = $osjsUserRepository;
        $this->organization = Auth::user()->organization()->first();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.osjs_users.index')->with('users', $this->organization->users()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.osjs_users.create');
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
        $user = $this->osjsUserRepository->create($request->all());

        if ($service->createUserDirectory($user->username)) {

            $user->organization()->associate($this->organization);
            $user->save();

            Flash::success(Lang::get('osjs_users.create-success'));
            return redirect(action('OsjsUsersController@index'));
        } else {
            Flash::error(Lang::get('osjs_users.create-failed'));
            return redirect(action('OsjsUsersController@create'));
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

        return view('pages.osjs_users.show')->with('user', $user);
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

        return view('pages.osjs_users.edit')->with('user', $user);
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

        Flash::success(Lang::get('osjs_users.update-success'));

        return redirect(action('OsjsUsersController@show', ['id' => $id]));
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
