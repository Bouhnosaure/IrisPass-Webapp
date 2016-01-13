<?php

$I = new ApiTester($scenario);

$I->wantTo('sign up an user');

$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('auth/signup', ['username' => 'user', 'email' => 'alex@mail.fr', 'password' => '123123']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$I->signin('alex@mail.fr', '123123');
