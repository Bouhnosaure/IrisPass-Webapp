<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Create an user');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('UsersController@create');


//modify user
$I->fillField(['name' => 'profile[firstname]'], 'josh');
$I->fillField(['name' => 'profile[lastname]'], 'josh');
$I->fillField(['name' => 'password'], '123123');
$I->fillField(['name' => 'password_confirmation'], '123123');


$I->click('submit-osjs-users-create');

//$I->canSee('josh');