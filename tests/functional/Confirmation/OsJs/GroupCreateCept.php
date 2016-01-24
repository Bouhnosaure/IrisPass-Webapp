<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Create a group');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('OsjsGroupsController@create');


//modify user
$I->fillField(['name' => 'name'], 'group test');
$I->click('submit-osjs-groups-create');

$I->amOnAction('OsjsGroupsController@index');
$I->canSee('group test');

$I->seeInDatabase('osjs_groups',['name' => 'group test']);