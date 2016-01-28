@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">
                <h3>Votre organisation</h3>
            </div>


            @if($organization)


                <div class="row">
                    <div class="col-sm-12">
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <img src="images/theme/admin/orga.png"
                                             alt="user-avatar" class="profile-avatar"/>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="personal">
                                        <h1 class="name">{{$organization->name}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <div class="tab-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">Information</a>
                                </li>
                                <li><a data-toggle="tab" href="#friends">Groupes</a></li>
                                <li><a data-toggle="tab" href="#settings">Utilisateurs</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane active cont">
                                    <table class="no-border no-strip information">
                                        <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td style="width:20%;" class="category">
                                                <strong>CONTACT</strong>
                                            </td>
                                            <td>
                                                <table class="no-border no-strip skills">
                                                    <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:20%;"><b>Adresse</b></td>
                                                        <td>{{$organization->address}}
                                                            , {{$organization->address_comp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;"><b>E-mail</b></td>
                                                        <td>{{$organization->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%;"><b>Mobile</b></td>
                                                        <td>{{$organization->phone}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="friends" class="tab-pane cont">
                                    @if($groups)
                                        @foreach($groups as $group)

                                            <table class="no-border no-strip information">
                                                <tbody class="no-border-x no-border-y">
                                                <tr>
                                                    <td style="width:20%;" class="category">
                                                        <strong>Groupes de {{$organization->name}}</strong>
                                                    </td>
                                                    <td>
                                                        <table class="no-border no-strip skills">
                                                            <thead>
                                                            <tr>
                                                                <td style="width:20%;"><b>Nom</b></td>

                                                                <td style="width:20%;"><b>Créé le</b></td>


                                                                <td style="width:20%;"><b>Dernière modification : </b>
                                                                </td>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="no-border-x no-border-y">
                                                            <tr>
                                                                <td>{{$group->name}}</td>


                                                                <td>{{$group->created_at->diffForHumans()}}</td>

                                                                <td>{{$organization->updated_at->diffForHumans()}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        @endforeach

                                    @endif

                                </div>
                                <div id="settings" class="tab-pane">

                                </div>
                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>

            @else
                Aucune organisation n'est créée pour le moment, veuillez en enregistrer
                une içi
                :
                <a class="btn btn-success pull-right"
                   href="{{action('OrganizationController@create')}}">{{ trans('organization.create')}}</a>
                <br>

            @endif

        </div>
    </div>


@endsection