<?php
$I = new FunctionalTester($scenario);
$I->resetEmails();

//setup
$I->am('a user');
$I->wantTo('activate my email adress');

$I->amAuthenticatedWithCredentials();
$I->canSeeAuthentication();

$I->amOnPage('/confirmation');

//action
//step1
$I->click('#submit-mail-code');

//step2
$I->seeInLastEmail('admin@irispass.fr');
$I->seeInLastEmail('Confirmation Code');

//step3
$I->seeRecord('users_confirmations', ['user_id' => 1, 'type' => 'mail']);

//step4
$code = $I->grabRecord('users_confirmations', ['user_id' => 1, 'type' => 'mail']);
$I->amOnPage('/confirmation/mail/' . $code->confirmation_code);


$I->dontSee('#submit-mail-code');
$I->seeRecord('users_profiles', ['user_id' => 1, 'mail_confirmed' => 1]);
