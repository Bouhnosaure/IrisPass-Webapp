<?php
$I = new FunctionalTester($scenario);
$I->resetEmails();

//setup
$I->am('a user');
$I->wantTo('activate my phone number');
$I->amAuthenticatedWithCredentials();
$I->amOnPage('/confirmation');

//action
//step1
$I->click('#submit-phone-code');

//step2
$I->seeInLastEmail('admin@irispass.fr');
$I->seeInLastEmail('Confirmation Code');

//step3
$I->seeRecord('users_confirmations', ['user_id' => 1, 'type' => 'phone']);

//step4
$code = $I->grabRecord('users_confirmations', ['user_id' => 1, 'type' => 'phone']);
$I->seeCurrentUrlEquals('/confirmation/phone');
$I->fillField(['name' => 'code'], $code->confirmation_code);
$I->click('submit-confirmation-code');

$I->dontSee('#submit-phone-code');
$I->seeRecord('user_profiles', ['user_id' => 1, 'phone_confirmed' => 1]);