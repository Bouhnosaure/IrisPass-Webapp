<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('test if my app is up');


$I->amOnAction('PagesController@index');
$I->seeResponseCodeIs(200);
