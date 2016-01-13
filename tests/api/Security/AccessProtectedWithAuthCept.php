<?php

$I = new ApiTester($scenario);
$I->wantTo('Access a protected resource with token');

$I->amAuthenticatedWithJWT();

$I->sendGET('test/secure');

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();