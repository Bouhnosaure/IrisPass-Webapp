<?php namespace App\Http\Controllers;

use App\Helpers\Plans;
use App\Http\Requests;
use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\OrganizationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class OrganizationController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $organizationRepository;
    private $organization;

    /**
     * @param OrganizationRepositoryInterface $organizationRepository
     * @internal param UserRepositoryInterface $userRepository
     */
    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization', ['except' => ['index', 'create', 'store']]);

        $this->organizationRepository = $organizationRepository;

        $this->organization = Auth::user()->organization()->first();

        Carbon::setLocale('fr');
    }

    /**
     * Show the profile of an user
     *
     * @return Response
     */
    public function index()
    {

        $organization = $this->organization;

        if ($organization != null) {
            $groups = $this->organization->groups()->get();
            $users = $this->organization->users()->get();
        }

        return view('pages.organization.index')->with(compact('organization', 'groups', 'users'));

    }

    /**
     * Show the form for creating a new carpooling.
     * @return Response
     * @internal param Event $event
     */
    public function create()
    {

        if ($this->organization != null) {
            Flash::error(Lang::get('organization.fail-exists'));
            return redirect(action('OrganizationController@index'));
        } else {
            return view('pages.organization.create');
        }
    }

    /**
     * Store a newly created carpooling in storage.
     *
     * @param OrganizationRequest $request
     * @return Response
     */
    public function store(OrganizationRequest $request)
    {

        if (starts_with($request->get('name'), ['www']) || in_array($request->get('name'), ['cms', 'irispass', 'mail', 'desktop', 'bureau', 'chat', 'www', 'office', 'iris', 'only', 'admin'])) {
            Flash::error(Lang::get('organization.fail-name'));
            return redirect(action('OrganizationController@index'));
        }

        $this->organization = $this->organizationRepository->create($request->all());

        $this->organization->owner()->associate(Auth::user());

        $this->organization->save();

        Flash::success(Lang::get('organization.create-success'));

        return redirect(action('OrganizationController@index'));
    }

    /**
     * Show the form for editing the profile of the authenticated user
     *
     * @return Response
     */
    public function edit()
    {
        return view('pages.organization.edit')->with('organization', $this->organization);
    }

    /**
     * Update the profile of the authenticated user
     *
     * @param OrganizationRequest|UserProfileRequest $request
     * @return Response
     */
    public function update(OrganizationRequest $request)
    {
        $this->organizationRepository->update($this->organization->id, $request->all());

        Flash::success(Lang::get('organization.update-success'));

        return redirect(action('OrganizationController@edit'));
    }

    /*
     * ADMIN AREA
     */

    #Get all and update this or this


}
