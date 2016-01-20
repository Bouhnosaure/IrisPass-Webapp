<?php
$I = new FunctionalTester($scenario);

$I->am('an user');
$I->wantTo('Update my profile');

//setup
$I->amAuthenticatedWithCredentials();
$I->amOnAction('ProfileController@edit');

$user = \App\User::find(1);

//save
$_email = $user->email;
$_firstname = $user->profile->firstname;
$_lastname = $user->profile->lastname;
$_phone = $user->profile->phone;


//modify user
$I->fillField(['name' => 'email'], 'johndoe@foe.com');
$I->fillField(['id' => 'firstname'], 'John');
$I->fillField(['id' => 'lastname'], 'Doe');
$I->fillField(['id' => 'phone'], '+33616391876');
$I->click('submit-edit');

$I->cantSeeInField(['name' => 'email'], $_email);
$I->cantSeeInField(['id' => 'firstname'], $_firstname);
$I->cantSeeInField(['id' => 'lastname'], $_lastname);
$I->cantSeeInField(['id' => 'phone'], $_phone);


//reset user test
$I->fillField(['name' => 'email'], $_email);
$I->fillField(['id' => 'firstname'], $_firstname);
$I->fillField(['id' => 'lastname'], $_lastname);
$I->fillField(['id' => 'phone'], $_phone);
$I->click('submit-edit');

$I->seeInDatabase('users',['email' => $_email]);
$I->seeInDatabase('user_profiles',['phone' => $_phone]);