<?php
$I = new FunctionalTester($scenario);

//setup
$I->am('a user');
$I->wantTo('login into my account');
$I->haveInDatabase('users',[
    'name' => 'JohnDoe',
    'slug' => 'johndoe',
    'email' => 'john.doe@mail.com',
    'password' => bcrypt('password'),
    'created_at' => '2015-03-29 19:48:28',
    'updated_at' => '2015-03-29 19:48:28'
]);

//action
$I->amOnPage('/auth/login');
$I->see('Connexion');
$I->fillField(['name' => 'email'], 'john.doe@mail.com');
$I->fillField(['name' => 'password'], 'password');
$I->click('submit-login');

//verify
$I->seeCurrentActionIs('EventsController@index');
$I->canSeeAuthentication();

