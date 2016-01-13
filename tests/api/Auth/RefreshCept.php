<?php

$I = new ApiTester($scenario);
$I->wantTo('refresh a token');

$I->amAuthenticatedWithJWT();
$I->sendPOST('auth/refresh', []);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();