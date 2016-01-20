<?php
$I = new FunctionalTester($scenario);

//setup
$I->am('a guest');
$I->wantTo('register an account');

//action
$I->amOnPage('/auth/register');
$I->see('Inscription');
$I->fillField(['name' => 'name'], 'JohnxDoe');
$I->fillField(['name' => 'email'], 'john.doe@mail.com');
$I->fillField(['name' => 'password'], 'password');
$I->fillField(['name' => 'password_confirmation'], 'password');
$I->click('submit-register');

//verify
$I->canSeeAuthentication();
$I->seeRecord('users', array('email' => 'john.doe@mail.com'));

