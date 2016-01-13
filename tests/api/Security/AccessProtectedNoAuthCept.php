<?php

$I = new ApiTester($scenario);
$I->wantTo('Access a protected resource without token');

$I->sendGET('test/secure');

$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();