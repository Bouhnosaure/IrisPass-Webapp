<?php namespace App\Http\Controllers;

use App\Billing;
use App\Http\Requests;
use App\Http\Requests\InitializeBillingRequest;
use App\Repositories\UserRepositoryInterface;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $organization;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasOrganization');
        $this->organization = Auth::user()->organization()->first();
        Carbon::setLocale('fr');
    }

    /**
     * Subscription options and billing
     */
    public function index()
    {
        $organization = $this->organization;
        $subscription = $this->organization->subscription()->first();
        $plans = config('plans.pricing');

        return view('pages.subscriptions.index')->with(compact('organization', 'subscription', 'plans'));

    }

    /**
     * Subscription options and billing
     */
    public function create($planid)
    {
        $organization = $this->organization;
        $category = $planid;
        $plan = config("plans.pricing.{$category}");

        return view('pages.subscriptions.create')->with(compact('organization', 'category', 'plan'));

    }


    public function initializeBilling(InitializeBillingRequest $request)
    {

        //TODO FAIRE UN SERVICE NON et des repository ?

        $category = $request->get('category');
        $uuid = base64_encode(time());
        $plan = config("plans.pricing.{$category}");
        $users_sup = $request->get('users');
        $plan['limits']['base'] = +$users_sup;

        $subscription = new Subscription();
        $subscription->price_base = $plan['price'];
        $subscription->category = $category;
        $subscription->price_current = $plan['price'] + $users_sup; //TODO CALCUL SAVANT
        $subscription->values = json_encode($plan);
        $subscription->is_active = false;
        $subscription->last_billing_uuid = $uuid;

        $billing = new Billing();
        $billing->uuid = $uuid;
        $billing->status = "NOT-BILLED";
        $billing->price = $subscription->price_current;
        $billing->is_billed = false;

        $subscription->organization()->associate($this->organization);
        $subscription->save();

        $billing->subscription()->associate($subscription);
        $billing->organization()->associate($this->organization);
        $billing->save();

        return redirect(); //TODO ENV REDIRECT URL

    }

    public function handleWebhook(Request $request)
    {
        //TODO FAIRE UN HASH POUR RECRER TOUTE L'OP SANS AUTH

        $subscription = $this->organization->subscription()->first();
        $billing = Billing::where('uuid', $subscription->last_billing_uuid)->get()->first();

        if ($request->input('status') == 'success') {

            $subscription->is_active = true;
            $subscription->save();

            $billing->status = "SUCCESS"; //TODO DEFINIR DES CODES DERREURS ?
            $billing->is_billed = true;
            $billing->save();

        } else {

            $billing->status = "ERROR";
            $billing->save();

        }
    }

    public function handleRedirect()
    {
        return redirect(action('SubscriptionController@index')); //TODO LEL
    }


}
