<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Create an user');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('OsjsUsersController@create');


//modify user
$I->fillField(['username' => 'name'], 'josh');
$I->fillField(['name' => 'name'], 'josh');
$I->fillField(['password' => 'name'], '123123');
$I->fillField(['password_confirmation' => 'name'], '123123');


$I->click('submit-osjs-users-create');

$I->amOnAction('OsjsUsersController@index');
$I->canSee('josh');

$I->seeInDatabase('osjs_users',['name' => 'josh']);