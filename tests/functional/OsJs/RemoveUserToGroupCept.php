<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Remove an user from a group');

//setup
$I->amAuthenticatedWithCredentials();

$I->haveRecord('osjs_groups', [
    'name' => 'group_test',
    'organization_id' => '1',
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

$I->amOnPage(action('VirtualDesktopController@index'));

$I->canSee('group_test');

$I->click('submit-usergroup-enable');

$I->canSeeElement('.alert-success');

$I->click('submit-usergroup-disable');

$I->canSeeElement('.alert-success');
