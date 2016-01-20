<?php
$I = new FunctionalTester($scenario);
$I->resetEmails();

//setup
$I->am('a user');
$I->wantTo('retrieve the password and change it from my account');
$I->amOnPage('/password/email');
$I->cantSeeAuthentication();
$user = \App\User::find(1);

//action
//step 1
$I->see('mot de passe');
$I->fillField(['name' => 'email'], $user->email);
$I->click('submit-password');

//step2
$I->seeInLastEmail('admin@tawa.com');
$I->seeInLastEmail('Your Password Reset Link');

//step3
$I->seeRecord('password_resets',['email' => $user->email]);

$password_reset = $user = DB::table('password_resets')->where('email', $user->email)->first();
$I->amOnPage('/password/reset/'.$password_reset->token);

$I->fillField(['name' => 'email'], $user->email);
$I->fillField(['name' => 'password'], 'password');
$I->fillField(['name' => 'password_confirmation'], 'password');
$I->click('submit-reset');

$I->canSeeAuthentication();



