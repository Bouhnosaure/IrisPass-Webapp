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


            <div class="col-md-3 col-sm-6">
                @if($organization->maxusers > 5)

                    <div class="fd-tile tile-prusia weather">
                        <a class="btn btn-primary btn-info btn-rad">Renouveler</a>
                        @else

                            <div class="fd-tile tile-concrete weather">
                                <a class="btn btn-primary btn-info btn-rad">Souscrire à la version pro</a>
                                @endif

                                @if($organization->maxusers > 5)
                                    <h2>Irispass Pro</h2>
                                    <h1>N € / An</h1>
                                @else
                                    <h2>Irispass Démo</h2>
                                    <h1>Gratuit</h1>
                                @endif
                                <div class="row days">
                                    <div class="col-xs-4 day">
                                        <h6>Utilisateurs max</h6>
                                        <p>{{$organization->maxusers}}</p>
                                    </div>
                                    <div class="col-xs-4 day">
                                        <h6>Depuis le</h6>
                                        <p>{{$organization->date_start->format('l jS \\of F Y h:i:s A')}}</p>
                                    </div>
                                    <div class="col-xs-4 day">
                                        <h6>Expire le</h6>
                                        <p>{{$organization->date_end->format('l jS \\of F Y h:i:s A')}}</p>
                                    </div>
                                </div>
                            </div>
                    </div>


@endsection