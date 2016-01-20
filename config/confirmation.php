<?php

return [

    /*
	|--------------------------------------------------------------------------
	| Confirmation by mail
	|--------------------------------------------------------------------------
	|
    | This is for activate the mail confirmation, if active an user can confirm
    | by Mail, otherwise he can't and a flash message should be throw and says
    | that this functionality is not activated now
	|
	*/
    'mail' => true,

    /*
	|--------------------------------------------------------------------------
	| Confirmation by sms
	|--------------------------------------------------------------------------
	|
    | This is for activate the SMS confirmation, if active an user can confirm
    | by SMS gateway, otherwise he can't and a flash message should be throw and says
    | that this functionality is not activated now
	|
	*/
    'phone' => true,

    /*
	|--------------------------------------------------------------------------
	| Sms debug
	|--------------------------------------------------------------------------
	|
    | This is for bypass sms sending and send the message by mail for debug purposes
    | with mailtrap.io
	|
	*/
    'phone_debug' => env('PHONE_DEBUG', true),

];