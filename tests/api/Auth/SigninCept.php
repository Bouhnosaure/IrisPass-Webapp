<?php

// login method is located in _support/ApiTester.php

$I = new ApiTester($scenario);
$I->wantTo('sign in an user');

$I->signin('alexandre.mangin@viacesi.fr', '123123');

