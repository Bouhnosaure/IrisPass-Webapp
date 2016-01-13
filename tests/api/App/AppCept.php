<?php

$I = new ApiTester($scenario);
$I->wantTo('know is app is alive');

$I->sendGET('/', []);

$I->seeResponseCodeIs(200);