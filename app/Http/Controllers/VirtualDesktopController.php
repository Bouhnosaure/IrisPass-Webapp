<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VirtualDesktopController extends Controller
{

    private $organization;

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

        if ($organization != null) {
            $groups = $this->organization->groups()->get();
            $users = $this->organization->users()->get();
        }

        return view('pages.virtualdesktop.index')->with(compact('organization', 'groups', 'users'));

    }


}
