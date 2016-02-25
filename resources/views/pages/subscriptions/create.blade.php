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

            {!! Form::open(['method' => 'POST','action' => ['SubscriptionController@initializeBilling']]) !!}

            <div class="col-md-12 col-sm-12">
                <div class="fd-tile tile-prusia weather">
                    <p>{{$plan['name']}}</p>
                    <div class="fd-tile tile-concrete weather">

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

            <div class="col-md-12">

                <div class="form-group">
                    <label>Nombre d'utilisateurs supplémentaires</label>
                    <input type="number" name="users" value="0" class="form-control">
                </div>

                <input type="hidden" name="category" value="{{$category}}">
                <button class="btn btn-block btn-primary" name="submit-access-payment-platform" type="submit">{{trans('subscription.access-payment-platform')}}</button>
                <!--
                    A ce moment là créer une subscription en attente avec les paramètres
                    Et créer une ligne de billing
                    Rediriger l'user vers le site de paiement en passant le webhook
                    le webhook dira si ça passe ou pas genre (subscribe/webhook)
                    et aussi une redirect url pour ramener l'user a bon port genre (subscribe/redirect)

                    et là si ça passe on met true aux deux sinon on laisse a false

                    et après on implemente les mecanismes de limitation :D et c'est Guuud my friend!
                -->
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection