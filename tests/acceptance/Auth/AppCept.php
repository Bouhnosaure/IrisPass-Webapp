<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('test if i can see login option on front page');

$I->amOnAction('PagesController@index');
$I->seeResponseCodeIs(200);


