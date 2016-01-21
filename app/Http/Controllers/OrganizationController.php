<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\OrganizationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use Spatie\Glide\GlideImage;

class OrganizationController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $organizationRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->middleware('auth');
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * Show the profile of an user
     *
     * @return Response
     */
    public function index()
    {
        $organization = Auth::user()->organization();

        return view('pages.organization.index')->with('organization', $organization);
    }

    /**
     * Show the form for creating a new carpooling.
     * @return Response
     * @internal param Event $event
     */
    public function create()
    {
        $organization = Auth::user()->organization();

        if ($organization != null) {
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
        $organization = $this->organizationRepository->create($request->all());

        $user = Auth::user();
        $user->organization()->attach($organization);
        $user->save();

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
        $organization = Auth::user()->organization()->get();

        return view('pages.organization.edit')->with('organization', $organization);
    }

    /**
     * Update the profile of the authenticated user
     *
     * @param OrganizationRequest|UserProfileRequest $request
     * @return Response
     */
    public function update(OrganizationRequest $request)
    {
        $this->organizationRepository->update(Auth::user()->id, $request->all());

        Flash::success(Lang::get('organization.update-success'));

        return redirect(action('OrganizationController@edit'));
    }


    /**
     * Subscription options and billing
     */
    public function subscriptions()
    {

        return view('pages.organization.subscriptions');

    }


}
