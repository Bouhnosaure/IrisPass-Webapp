@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('organization.index') }}</h3>
                </div>
                <div class="content">

                    @if(1)
                        "existe"

                        abonné ?
                        ou pas ?
                        si oui infos + option pour upgrade
                        sinon => achat
                    @else
                        "existe pas"
                        <br>
                        <a href="{{action('OrganizationController@create')}}">{{ trans('organization.create') }}</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection