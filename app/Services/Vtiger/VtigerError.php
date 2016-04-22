<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 18/10/2015
 * Time: 22:39
 */

namespace App\Services\Vtiger;


class VtigerError
{
    protected $_code;
    protected $_message;

    /**
     * [[Description]]
     * @param [[Type]] $_message    [[Description]]
     * @param int $_code
     */
    public function __construct($_message, $_code = 0)
    {
        $this->_code = $_code;
        $this->_message = $_message;
    }

    /**
     * [[Description]]
     * @return string [[Description]]
     */
    public function __toString()
    {
        return "WSClient Error [{$this->_code}]: {$this->_message}";
    }

    /**
     * [[Description]]
     * @param bool $addErrorProp
     * @return string [[Type]] [[Description]]
     * @internal param $ [[Type]] [$addErrorProp = true] [[Description]]
     */
    public function toJson($addErrorProp = true)
    {
        $error = [
            'code' => $this->_code,
            'message' => $this->_message
        ];
        if ($addErrorProp)
            $error = array_merge(['error' => true], $error);
        return json_encode($error);
    }
}