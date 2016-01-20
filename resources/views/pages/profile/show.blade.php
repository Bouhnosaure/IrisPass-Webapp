@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="profile">
                    <div class="profile-text">
                        <h1>{{$user->profile->firstname}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop