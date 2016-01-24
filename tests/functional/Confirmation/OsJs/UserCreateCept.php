<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Create an user');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('OsjsUsersController@create');


//modify user
$I->fillField(['name' => 'username'], 'josh');
$I->fillField(['name' => 'name'], 'josh');
$I->fillField(['name' => 'password'], '123123');
$I->fillField(['name' => 'password_confirmation'], '123123');


$I->click('submit-osjs-users-create');

$I->amOnAction('OsjsUsersController@index');
$I->canSee('josh');