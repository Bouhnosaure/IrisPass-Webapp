<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    private $email = "alexandre.mangin@viacesi.fr";
    private $password = "123123";


    public function signin($email, $password)
    {
        $I = $this;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('auth/signin', ['email' => $email, 'password' => $password]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $token = $I->grabDataFromResponseByJsonPath('token');
        $I->haveInDatabase('cache', array('key' => 'bearer', 'value' => $token[0]));
    }

    public function getBearer()
    {
        $I = $this;
        $token = $I->grabFromDatabase('cache', 'value', array('key' => 'bearer'));
        return $token;
    }

    public function amAuthenticatedWithJWT()
    {
        $I = $this;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('auth/signin', ['email' => $this->email, 'password' => $this->password]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $token = $I->grabDataFromResponseByJsonPath('token');
        $I->amBearerAuthenticated($token[0]);
    }
}