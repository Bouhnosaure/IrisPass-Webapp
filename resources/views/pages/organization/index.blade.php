@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('organization.index') }}</h3>
                </div>
                <div class="content">

                    @if($organization)
                        "existe"

                        <br>

                        Création d'un dashboard a venir avec lien vers les utilisateur, groupes, etc

                    @else
                        "existe pas"
                        <br>
                        <a class="btn btn-primary" href="{{action('OrganizationController@create')}}">{{ trans('organization.create') }}</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection