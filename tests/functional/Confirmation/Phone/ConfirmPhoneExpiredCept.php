<?php
$I = new FunctionalTester($scenario);
$I->resetEmails();

//setup
$I->am('a user');
$I->wantTo('activate my phone number with expired code');
$I->amAuthenticatedWithCredentials();

$I->haveRecord('users_confirmations', [
    'type' => 'phone',
    'confirmation_code' => '1234',
    'user_id' => 1,
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

//action
//step 1
$code = $I->grabRecord('users_confirmations', ['user_id' => 1, 'type' => 'phone']);

//step2
$I->amOnPage('/confirmation/phone');
$I->fillField(['name' => 'code'], $code->confirmation_code);
$I->click('submit-confirmation-code');

//step5
$I->seeCurrentUrlEquals('/confirmation');
$I->seeElement('#submit-phone-code');
$I->dontSeeRecord('users_profiles', ['user_id' => 1, 'phone_confirmed' => 1]);