<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Add an user to a group');

//setup
$I->amAuthenticatedWithCredentials();

$I->haveRecord('osjs_groups', [
    'name' => 'group_test',
    'organization_id' => '1',
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

$I->amOnAction('OsjsUserGroupsController@index');

$I->canSee('group_test');

$I->click('submit-enable');

$I->canSeeElement('.alert-success');
