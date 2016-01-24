<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Update a group');

$I->haveRecord('osjs_groups', [
    'name' => 'test_group',
    'path' => '/var/www/test',
    'organization_id' => '1',
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('OsjsGroupsController@index');

$I->click('test_group');
$I->click('groups-edit');


//modify user
$I->fillField(['name' => 'name'], 'test_groups_2');
$I->click('submit-osjs-groups-create');

$I->amOnAction('OsjsGroupsController@index');

$I->cantSee('test_groups_2');

$I->seeInDatabase('osjs_groups',['name' => 'test_groups_2']);