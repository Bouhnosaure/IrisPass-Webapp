<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteRequest;
use App\Jobs\CreateWebsite;
use App\Repositories\WebsiteRepositoryInterface;
use App\Services\FlatCmService;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class WebsiteController extends Controller
{
    use DispatchesJobs;

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

        $website = $organization->website()->first();

        return view('pages.website.index')->with(compact('organization', 'website'));

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
     * @param WebsiteRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param FlatCmService $service
     * @internal param WebsiteRepositoryInterface $websiteRepository
     */
    public function store(WebsiteRequest $request)
    {

        $identifier = str_slug($this->organization->name, "-");
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        $this->dispatch(new CreateWebsite($this->organization->id, $identifier, $username, $email, $password));

        Flash::success(Lang::get('website.create-success'));
        return redirect(action('WebsiteController@index'));

    }

}
