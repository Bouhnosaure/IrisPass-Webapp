<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Create a group');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('GroupsController@create');


//modify user
$I->fillField(['name' => 'name'], 'group test');
$I->click('submit-osjs-groups-create');

$I->amOnPage(action('UsersManagementController@index'));
$I->canSee('group test');