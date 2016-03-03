<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Services\OsjsService;
use App\User;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{

    private $organization;

    /**
     * @internal param UserRepositoryInterface $userRepository
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');

        $this->organization = Auth::user()->organization()->first();

        Carbon::setLocale('fr');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function store(UserProfileRequest $request, OsjsService $service)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['groups'] = '["admin"]';

        $user = User::create($data);

        if ($path = $service->createDirectory('user', $user->username)) {

            $user->path = $path;
            $user->organization()->associate($this->organization);
            $user->save();

            Flash::success(Lang::get('users.create-success'));
            return redirect(action('UsersManagementController@index') . '#orgausers');
        } else {
            Flash::error(Lang::get('users.create-failed'));
            return redirect(action('UsersController@create'));
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
        $user = User::findOrFail($id);

        return view('pages.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request, $id, OsjsService $service)
    {
        $old_user = User::findOrFail($id);

        $user = User::findOrFail($id);
        $data = $request->all();

        if ($data['password'] == "") {
            unset($data["password"]);
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        $user->save();

        $user = User::findOrFail($id);

        if ($path = $service->renameDirectory('user', $old_user->username, $user->username)) {

            $user->path = $path;
            $user->save();

            Flash::success(Lang::get('users.update-success'));
        } else {
            Flash::error(Lang::get('users.update-failed'));
        }


        return redirect(action('UsersController@show', ['id' => $id]));
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
        $user = User::findOrFail($id);

        if ($path = $service->deleteDirectory('user', $user->username)) {

            $user->delete();

            Flash::success(Lang::get('users.destroy-success'));
        } else {
            Flash::error(Lang::get('users.destroy-failed'));
        }

        return redirect(action('UsersManagementController@index') . '#orgausers');

    }
}
