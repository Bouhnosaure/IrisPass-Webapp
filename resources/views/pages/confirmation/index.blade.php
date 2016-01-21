@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('confirmation.confirmation') }}</h3>
                </div>
                <div class="content">


                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ trans('confirmation.type') }}</th>
                            <th>{{ trans('confirmation.is_confirmed') }}</th>
                            <th>{{ trans('confirmation.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Config::get('confirmation.mail'))
                            <tr>
                                <td>{{ trans('confirmation.mail') }}</td>
                                @if($user->profile->mail_confirmed)
                                    <td>{{ trans('confirmation.is_valid') }}</td>
                                    <td>{{ trans('confirmation.is_valid') }}</td>
                                @else
                                    <td>
                                        {{ trans('confirmation.is_not_valid') }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" id="submit-mail-code"
                                           href="{{action('Auth\ConfirmationController@send',['type' => 'mail' ])}}">
                                            {{ trans('confirmation.send-confirmation') }}
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endif

                        @if(Config::get('confirmation.phone'))
                            <tr>
                                <td>{{ trans('confirmation.phone') }}</td>
                                @if($user->profile->phone_confirmed)
                                    <td>{{ trans('confirmation.is_valid') }}</td>
                                    <td>{{ trans('confirmation.is_valid') }}</td>
                                @else
                                    <td>
                                        {{ trans('confirmation.is_not_valid') }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" id="submit-phone-code"
                                           href="{{action('Auth\ConfirmationController@send',['type' => 'phone' ])}}">
                                            {{ trans('confirmation.send-confirmation') }}
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop


