<?php
$I = new FunctionalTester($scenario);

//setup
$I->am('a user');
$I->wantTo('logout from my account');
$I->amAuthenticatedWithCredentials();
$I->canSeeAuthentication();

//action
$I->amOnPage('/logout');

//verify
$I->canSeeCurrentUrlEquals('');
$I->cantSeeAuthentication();

