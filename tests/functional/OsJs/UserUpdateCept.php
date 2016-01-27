<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Update an user');

$I->haveRecord('osjs_users', [
    'name' => 'josh',
    'username' => 'josh',
    'organization_id' => 1,
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('OsjsUsersController@index');

$I->click("//*[text()[contains(.,'josh')]]/following-sibling::td[2]/a[1]");

$I->click("Editer");

//modify user
$I->fillField(['name' => 'username'], 'john');
$I->fillField(['name' => 'name'], 'john');

$I->click('submit-osjs-users-create');

$I->amOnAction('OsjsUsersController@index');

$I->see('john');