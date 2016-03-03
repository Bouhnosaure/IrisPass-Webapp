<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserProfileRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the profile of an user
     *
     * @return Response
     */
    public function index()
    {
        $user = User::with('profile')->findOrFail(Auth::user()->id);

        return view('pages.profile.show')->with('user', $user);
    }

    /**
     * Show the form for editing the profile of the authenticated user
     *
     * @return Response
     */
    public function edit()
    {
        $user = User::with('profile')->findOrFail(Auth::user()->id);

        return view('pages.profile.edit')->with('user', $user);
    }

    /**
     * Update the profile of the authenticated user
     *
     * @param UserProfileRequest $request
     * @return Response
     */
    public function update(UserProfileRequest $request)
    {
        $data = $request->all();

        $user = User::with('profile')->findOrFail(Auth::user()->id);

        $user->update($data);

        if (isset($data['profile'])) {
            $user->profile()->update($data['profile']);
        }

        Flash::success(Lang::get('profile.update-success'));

        return redirect(action('ProfileController@edit'));
    }


}
