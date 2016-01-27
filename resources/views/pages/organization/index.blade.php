@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>Votre organisation</h3>
                </div>
                <div class="content">

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
                                    <div class="row">
                                        <div class="col-sm-8">


                                            <div id="home" class="tab-pane active cont">
                                                <table class="no-border no-strip information">
                                                    <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:20%;" class="category"><strong>CONTACT</strong>
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

                                        </div>
                                    </div>
                                    <br>

                                    @else
                                        Aucune organisation n'est créée pour le moment, veuillez en enregistrer une içi
                                        :
                                        <a class="btn btn-success pull-right"
                                           href="{{action('OrganizationController@create')}}">{{ trans('organization.create')}}</a>
                                        <br>

                                    @endif

                                </div>
                            </div>
                        </div>
                </div>

@endsection