<?php
$I = new FunctionalTester($scenario);

//setup
$I->am('a user');
$I->wantTo('logout from my account');
$I->amLoggedAs(\App\User::find(1));
$I->canSeeAuthentication();

//action
$I->amOnPage('/auth/logout');

//verify
$I->canSeeCurrentUrlEquals('');
$I->cantSeeAuthentication();

