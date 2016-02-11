<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteRequest;
use App\Services\FlatCmService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class WebsiteController extends Controller
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
     * Show the desktops
     *
     * @return Response
     */
    public function index()
    {

        $organization = $this->organization;

        return view('pages.website.index')->with(compact('organization'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.website.create');
    }

    /**
     *
     * Activate CMS INSTANCE
     * @param FlatCmService $service
     * @param WebsiteRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FlatCmService $service, WebsiteRequest $request)
    {

        $identifier = str_slug($this->organization->name, "-");
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        if ($service->process($identifier, $username, $email, $password)) {

            $this->organization->crm_url = $identifier;
            $this->organization->is_active_cms = true;
            $this->organization->save();

            Flash::success(Lang::get('website.create-success'));
            return redirect(action('WebsiteController@index'));
        } else {
            Flash::error(Lang::get('website.create-failed'));
            return redirect(action('WebsiteController@create'));
        }
    }

}
