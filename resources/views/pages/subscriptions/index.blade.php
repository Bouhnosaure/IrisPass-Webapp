@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">

                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:28px;"><b>Offre souscrite pour {{$organization->name}}</b></p>
                    </div>
                </div>
                <hr>
            </div>

            @foreach($plans as $planid => $plan)

                <div class="col-md-3 col-sm-6">
                    <div class="fd-tile tile-prusia weather">
                        <p>{{$plan['name']}}</p>
                        <div class="fd-tile tile-concrete weather">
                            <a class="btn btn-primary btn-info btn-rad" href="{{action('SubscriptionController@create', $planid)}}">Souscrire</a>

                            <h2>{{$plan['name']}}</h2>
                            <h1>{{$plan['price']}} €</h1>

                            <div class="row days">
                                <div class="col-xs-4 day">
                                    <h6>Utilisateurs inclus</h6>
                                    <p>{{$plan['limits']['users']['base']}}</p>
                                </div>
                                <div class="col-xs-4 day">
                                    <h6>Utilisateurs max</h6>
                                    <p>{{$plan['limits']['users']['max']}}</p>
                                </div>
                                <div class="col-xs-4 day">
                                    <h6>Utilisateurs suppl.</h6>
                                    <p>{{$plan['limits']['users']['more']}}</p>
                                </div>
                            </div>
                            <div class="row days">
                                <div class="col-xs-4 day">
                                    <h6>Mini-sites</h6>
                                    <p>{{$plan['limits']['website']['base']}}</p>
                                </div>
                                <div class="col-xs-4 day">
                                    <h6>CRM</h6>
                                    <p>{{$plan['limits']['crm']['base']}}</p>
                                </div>
                                <div class="col-xs-4 day">
                                    <h6>Mails</h6>
                                    <p>{{$plan['limits']['mails']['base']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection