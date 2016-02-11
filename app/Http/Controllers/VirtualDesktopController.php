<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\OrganizationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class VirtualDesktopController extends Controller
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
        $this->middleware('hasOrganization');

        $this->organizationRepository = $organizationRepository;

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

        if ($organization != null) {
            $groups = $this->organization->groups()->get();
            $users = $this->organization->users()->get();
        }

        return view('pages.virtualdesktop.index')->with(compact('organization', 'groups', 'users'));

    }


}
