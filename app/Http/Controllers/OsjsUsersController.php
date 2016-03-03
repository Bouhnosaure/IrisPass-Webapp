<?php

namespace App\Http\Controllers;

use App\Http\Requests\OsjsUserRequest;
use App\OsjsUser;
use App\Services\OsjsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OsjsUsersController extends Controller
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
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['groups'] = '["admin"]';

        $user = OsjsUser::create($data);

        if ($path = $service->createDirectory('user', $user->username)) {

            $user->path = $path;
            $user->organization()->associate($this->organization);
            $user->save();

            Flash::success(Lang::get('osjs_users.create-success'));
            return redirect(action('VirtualDesktopController@index') . '#orgausers');
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
        $user = OsjsUser::findOrFail($id);

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
        $user = OsjsUser::findOrFail($id);

        return view('pages.osjs_users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OsjsUserRequest|Request $request
     * @param  int $id
     * @param OsjsService $service
     * @return \Illuminate\Http\Response
     */
    public function update(OsjsUserRequest $request, $id, OsjsService $service)
    {
        $old_user = OsjsUser::findOrFail($id);

        $user = OsjsUser::findOrFail($id);
        $data = $request->all();
        if ($data['password'] == "") {
            unset($data["password"]);
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        $user->save();

        $user = OsjsUser::findOrFail($id);

        if ($path = $service->renameDirectory('user', $old_user->username, $user->username)) {

            $user->path = $path;
            $user->save();

            Flash::success(Lang::get('osjs_users.update-success'));
        } else {
            Flash::error(Lang::get('osjs_users.update-failed'));
        }


        return redirect(action('OsjsUsersController@show', ['id' => $id]));
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
        $user = OsjsUser::findOrFail($id);

        if ($path = $service->deleteDirectory('user', $user->username)) {

            $user->delete();

            Flash::success(Lang::get('osjs_users.destroy-success'));
        } else {
            Flash::error(Lang::get('osjs_users.destroy-failed'));
        }

        return redirect(action('VirtualDesktopController@index') . '#orgausers');

    }
}
