<?php
$I = new FunctionalTester($scenario);
$I->resetEmails();

//setup
$I->am('a user');
$I->wantTo('activate my email adress with expired code');

$I->amAuthenticatedWithCredentials();
$I->canSeeAuthentication();

$I->haveRecord('users_confirmations', [
    'type' => 'mail',
    'confirmation_code' => 'KGcClDwrpbZn2XwHJbBTcqf28GrY5O',
    'user_id' => 1,
    'created_at' => '2015-05-08 00:00:00',
    'updated_at' => '2015-05-08 00:00:00'
]);

//step4
$code = $I->grabRecord('users_confirmations', ['user_id' => 1, 'type' => 'mail']);
$I->amOnPage('/confirmation/mail/' . $code->confirmation_code);

$I->seeElement('#submit-mail-code');
$I->dontSeeRecord('users_profiles', ['user_id' => 1, 'mail_confirmed' => 1]);