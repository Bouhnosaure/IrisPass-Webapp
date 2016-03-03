<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Update an user');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('UsersManagementController@index');

$I->click("//*[text()[contains(.,'Alexandre')]]/following-sibling::td[4]/a[1]");

$I->click("Editer");

//modify user
$I->fillField(['name' => 'profile[firstname]'], 'john');
$I->fillField(['name' => 'profile[lastname]'], 'johna');

$I->click('submit-osjs-users-create');

$I->amOnAction('UsersManagementController@index');

//$I->see('john');