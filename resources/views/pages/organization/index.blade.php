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

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>Organisation créée :</b></td>
                                                <td class="isp-value">{{$organization->created_at->diffForHumans()}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>Nombre de groupes :</b></td>
                                                <td class="isp-value">{{$groups->count()}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>Nombre d'utilisateurs : </b></td>
                                                <td class="isp-value">{{$users->count()}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                <li class="active"><a data-toggle="tab" href="#orgainfo">Information</a>
                                </li>
                                <li><a data-toggle="tab" href="#orgagroups">Groupes</a></li>
                                <li><a data-toggle="tab" href="#orgausers">Utilisateurs</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="orgainfo" class="tab-pane active cont">
                                    <table class="no-border no-strip information">
                                        <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td style="width:20%; font-size:14px;" class="category">
                                                <h4><strong>À propos de {{$organization->name}}</strong></h4>
                                            </td>
                                            <td>
                                                <table class="no-border no-strip skills">
                                                    <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:20%; font-size:15px;"><b>Adresse</b></td>
                                                        <td class="isp-value">{{$organization->address}}
                                                            , {{$organization->address_comp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%; font-size:14px;"><b>E-mail</b></td>
                                                        <td class="isp-value">{{$organization->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%; font-size:14px;"><b>Mobile</b></td>
                                                        <td class="isp-value">{{$organization->phone}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div id="orgagroups" class="tab-pane cont">

                                    @if($groups->count() != 0)

                                        <table class="no-border no-strip information">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:20%; font-size:14px;" class="category">
                                                   <h4><strong>Groupes de {{$organization->name}}</strong></h4>
                                                </td>
                                                <td>
                                                    <table class="no-border no-strip skills">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%; font-size:14px;"><b>Nom</b></td>
                                                            <td style="width:20%; font-size:14px;"><b>Créé</b></td>
                                                            <td style="width:20%; font-size:14px;"><b>Dernière mise à jour</b>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="no-border-x no-border-y">

                                                        @foreach($groups as $group)

                                                            <tr>
                                                                <td class="isp-value">{{$group->name}}</td>
                                                                <td class="isp-value">{{$group->created_at->diffForHumans()}}</td>
                                                                <td class="isp-value">{{$organization->updated_at->diffForHumans()}}</td>
                                                            </tr>

                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    @else

                                        <p class="isp-label"> Vous n'avez pas encore créé de groupe pour {{$organization->name}}. <a
                                                    class="btn btn-success pull-right"
                                                    href="{{action('OsjsGroupsController@create')}}">{{ trans('group.create')}}</a>
                                        </p>

                                    @endif

                                </div>
                                <div id="orgausers" class="tab-pane cont">

                                    @if($users->count() != 0)

                                        <table class="no-border no-strip information">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:20%; font-size:14px;" class="category">
                                                   <h4> <strong>Utilisateurs liés à {{$organization->name}}</strong></h4>
                                                </td>
                                                <td>
                                                    <table class="no-border no-strip skills">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%; font-size:14px;"><b>Identifiant</b></td>
                                                            <td style="width:20%; font-size:14px;"><b>Nom d'utilisateur</b></td>
                                                            <td style="width:20%; font-size:14px;"><b>Date de création</b>
                                                            <td style="width:20%; font-size:14px;"><b>Dernière mise à jour</b>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="no-border-x no-border-y">

                                                        @foreach($users as $user)

                                                            <tr>
                                                                <td class="isp-value">{{$user->username}}</td>
                                                                <td class="isp-value">{{$user->name}}</td>
                                                                <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                                                <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                                            </tr>

                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    @else

                                        <p class="isp-label"> Vous n'avez pas encore créé d'utilisateur pour {{$organization->name}}. <a
                                                    class="btn btn-success pull-right"
                                                    href="{{action('OsjsUsersController@create')}}">{{ trans('user.create')}}</a>
                                        </p>

                                    @endif

                                </div>
                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>

            @else

                <p class="isp-label"> Aucune organisation n'est créée pour le moment.<a class="btn btn-success pull-right"
                                                                      href="{{action('OrganizationController@create')}}">{{ trans('organization.create')}}</a>
                </p>

            @endif

        </div>
    </div>

@endsection