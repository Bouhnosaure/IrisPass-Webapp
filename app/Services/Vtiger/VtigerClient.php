<?php

namespace App\Services\Vtiger;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Vtiger Web Services PHP Client
 *
 * Class WSClient
 * @package Salaros\Vtiger\VTWSCLib
 */
class VtigerClient
{
    // HTTP Client instance
    protected $_client = false;
    // Service URL to which client connects to
    protected $_serviceUrl = false;
    protected $_serviceBase = 'webservice.php';
    // Webservice login validity
    private $_serviceServerTime = false;
    private $_serviceExpireTime = false;
    private $_serviceToken = false;
    // Webservice user credentials
    private $_userName = false;
    private $_accessKey = false;
    // Webservice login credentials
    private $_userID = false;
    private $_sessionName = false;
    // Vtiger CRM and WebServices API version
    private $_apiVersion = false;
    private $_vtigerVersion = false;
    // Last operation error information
    protected $_lastError = false;

    /**
     * Class constructor
     * @param string $url The URL of the remote WebServices server
     */
    public function __construct($url)
    {
        $this->_serviceUrl = VtigerUtils::getServiceURL($url);
        $this->_client = new Client([
            'base_url' => $this->_serviceUrl
        ]);
    }

    /**
     * Check if result has any error
     * @param  [[Type]] $json [[Description]]
     * @return boolean  [[Description]]
     */
    private function _checkForError($json)
    {
        if (isset($json['success']) && (bool)$json['success'] === true) {
            $this->_lasterror = false;
            return false;
        }
        $this->_lasterror = new VtigerError(
            $json['error']['message'],
            $json['error']['code']
        );
        return true;
    }

    /**
     * Checks and performs a login operation if requried
     * @access private
     */
    private function _checkLogin()
    {
        if (time() <= $this->_serviceExpireTime) {
            return;
        }
        $this->login($this->_userName, $this->_accessKey);
    }

    private function _sendRequest(array $reqdata, $method = 'POST')
    {
        try {
            switch ($method) {
                case 'GET':
                    $response = $this->_client->get($this->_serviceUrl . '/' . $this->_serviceBase, ['query' => $reqdata]);
                    break;
                case 'POST':
                    $response = $this->_client->post($this->_serviceUrl . '/' . $this->_serviceBase, ['form_params' => $reqdata]);
                    break;
                default:
                    $this->_lasterror = new VtigerError("Unknown request type {$method}");
                    return false;
            }
        } catch (RequestException $ex) {
            $this->lastError = new VtigerError(
                $ex->getMessage(),
                $ex->getCode()
	    );

            return $this->lastError;
        }


        $body = $response->getBody();
        $json = json_decode($body, true);

        if ($this->_checkForError($json)) {
            return false;
        } else {
            return $json['result'];
        }
    }

    /**
     * Performs the challenge
     * @access private
     */
    private function _challenge($username)
    {
        $getdata = [
            'operation' => 'getchallenge',
            'username' => $username
        ];

        $result = $this->_sendRequest($getdata, 'GET');

        $this->_serviceServerTime = $result['serverTime'];
        $this->_serviceExpireTime = $result['expireTime'];
        $this->_serviceToken = $result['token'];
        return true;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $username [[Description]]
     * @param  [[Type]] $accessKey [[Description]]
     * @return boolean [[Description]]
     */
    public function login($username, $accessKey)
    {
        // Do the challenge before loggin in
        if ($this->_challenge($username) === false)
            return false;
        $postdata = [
            'operation' => 'login',
            'username' => $username,
            'accessKey' => md5($this->_serviceToken . $accessKey)
        ];
        $result = $this->_sendRequest($postdata);
        if (!$result || !is_array($result))
            return false;
        // Backuping logged in user credentials
        $this->_userName = $username;
        $this->_accessKey = $accessKey;
        // Session data
        $this->_sessionName = $result['sessionName'];
        $this->_userID = $result['userId'];
        // Vtiger CRM and WebServices API version
        $this->_apiVersion = $result['version'];
        $this->_vtigerVersion = $result['vtigerVersion'];
        return true;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $username [[Description]]
     * @param  [[Type]] $password [[Description]]
     * @return boolean  [[Description]]
     */
    public function loginPassword($username, $password, &$accesskey = NULL)
    {
        // Do the challenge before loggin in
        if ($this->_challenge($username) === false)
            return false;
        $postdata = [
            'operation' => 'login_pwd',
            'username' => $username,
            'password' => $password
        ];
        $result = $this->_sendRequest($postdata);
        if (!$result || !is_array($result) || count($result) !== 1)
            return false;
        $accesskey = array_key_exists('accesskey', $result)
            ? $result['accesskey']
            : $result[0];
        return $this->login($username, $accesskey);
    }

    /**
     * Gets last operation error, if any
     * @return VtigerError The error object
     */
    public function getLastError()
    {
        return $this->_lastError;
    }

    /**
     * Returns the client library version.
     * @return string Client library version
     */
    public function getVersion()
    {
        return $this->_vtigerVersion;
    }

    /**
     * [[Description]]
     * @return boolean [[Description]]
     */
    public function getTypes()
    {
        // Perform re-login if required.
        $this->_checkLogin();
        $getdata = [
            'operation' => 'listtypes',
            'sessionName' => $this->_sessionName
        ];
        $result = $this->_sendRequest($getdata, 'GET');
        $modules = $result['types'];
        $result = array();
        foreach ($modules as $module) {
            $result[$module] = ['name' => $module];
        }
        return $result;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $module [[Description]]
     * @return boolean  [[Description]]
     */
    public function getType($module)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        $getdata = [
            'operation' => 'describe',
            'sessionName' => $this->_sessionName,
            'elementType' => $module
        ];
        return $this->_sendRequest($getdata, 'GET');
    }

    /**
     * [[Description]]
     * @param  [[Type]]       $module [[Description]]
     * @param  [[Type]]       $id     [[Description]]
     * @return boolean|string [[Description]]
     */
    public function getTypedID($module, $id)
    {
        if (stripos($id, 'x') !== false)
            return $id;
        $type = $this->getType($module);
        if (!$type || !array_key_exists('idPrefix', (array)$type)) {
            $this->_lasterror = new VtigerError("The following module is not installed:" . print_r($module, true));
            return false;
        }
        return "{$type['idPrefix']}x{$id}";
    }

    /**
     * Invokes custom operation
     * @param  string $method Name of the webservice to invoke
     * @param  array [$params = null] Object $type null or parameter values to method
     * @param  string [$type   = 'POST'] Request method (POST/GET)
     * @return boolean [[Description]]
     */
    public function invokeOperation($operation, array $params = null, $method = 'POST')
    {
        // Perform re-login if required
        $this->_checkLogin();
        $reqdata = [
            'operation' => $operation,
            'sessionName' => $this->_sessionName
        ];
        if (!empty($params) && is_array($params)) {
            $reqdata = array_merge($params);
        }
        return $this->_sendRequest($reqdata, $method);
    }

    /**
     * [[Description]]
     * @param  [[Type]] $query [[Description]]
     * @return boolean  [[Description]]
     */
    public function query($query)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        // Make sure the query ends with ;
        $query = trim($query);
        if (strripos($query, ';') != strlen($query) - 1) $query .= ';';
        $getdata = [
            'operation' => 'query',
            'sessionName' => $this->_sessionName,
            'query' => $query
        ];
        return $this->_sendRequest($getdata, 'GET');
    }

    /**
     * [[Description]]
     * @param  [[Type]] $id [[Description]]
     * @return boolean  [[Description]]
     */
    public function entityRetrieveByID($module, $id)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        // Preprend so-called moduleid if needed
        $id = $this->getTypedID($module, $id);
        $getdata = [
            'operation' => 'retrieve',
            'sessionName' => $this->_sessionName,
            'id' => $id
        ];
        return $this->_sendRequest($getdata, 'GET');
    }

    /**
     * [[Description]]
     * @param $module
     * @param $params
     * @param bool $cleanID
     * @return bool [[Description]]
     * @internal param $ [[Type]] $module  [[Description]]
     * @internal param $ [[Type]] $params  [[Description]]
     * @internal param $ [[Type]] $cleanID [[Description]]
     */
    public function entityRetrieveID($module, $params, $cleanID = true)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        if (empty($params) || !is_array($params)) {
            $this->_lasterror = new VtigerError("You have to specify at least on parameter (prop=>value) in order to retrieve entity ID");
            return false;
        }
        // Build the query
        $criteria = array();
        $query = "SELECT id FROM $module WHERE ";
        foreach ($params as $param => $value) {
            $criteria[] = "{$param} LIKE '{$value}'";
        }
        $query .= implode(" AND ", $criteria);
        $query .= " LIMIT 1";
        $records = $this->query($query);
        if (!$records || !is_array($records) || (count($records) !== 1))
            return false;
        $id = $records[0]['id'];
        return ($cleanID)
            ? VtigerUtils::getRecordID($id)
            : $id;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $module   [[Description]]
     * @param  [[Type]] $params [[Description]]
     * @return boolean  [[Description]]
     */
    public function entityCreate($module, $params)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        // Assign record to logged in user if not specified
        if (!isset($params['assigned_user_id'])) {
            $params['assigned_user_id'] = $this->_userID;
        }
        $postdata = [
            'operation' => 'create',
            'sessionName' => $this->_sessionName,
            'elementType' => $module,
            'element' => json_encode($params)
        ];
        return $this->_sendRequest($postdata);
    }

    /**
     * [[Description]]
     * @param  [[Type]] $module   [[Description]]
     * @param  [[Type]] $params [[Description]]
     * @return boolean  [[Description]]
     */
    public function entityUpdate($module, $params)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        // Assign record to logged in user if not specified
        if (!isset($params['assigned_user_id'])) {
            $params['assigned_user_id'] = $this->_userID;
        }
        if (array_key_exists('id', $params)) {
            $data = $this->entityRetrieveByID($module, $params['id']);
            if ($data !== false && is_array($data)) {
                $id = $data['id'];
                $params = array_merge(
                    $data,      // needed to provide mandatory field values
                    $params,    // updated data override
                    ['id' => $id] // fixing id, might be useful when non <moduleid>x<id> one was specified
                );
            }
        }
        $postdata = [
            'operation' => 'update',
            'sessionName' => $this->_sessionName,
            'elementType' => $module,
            'element' => json_encode($params)
        ];
        return $this->_sendRequest($postdata);
    }

    /**
     * [[Description]]
     * @param  [[Type]] $id [[Description]]
     * @return boolean  [[Description]]
     */
    public function entityDelete($module, $id)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        // Preprend so-called moduleid if needed
        $id = $this->getTypedID($module, $id);
        $postdata = [
            'operation' => 'delete',
            'sessionName' => $this->_sessionName,
            'id' => $id
        ];
        return $this->_sendRequest($postdata);
    }

    /**
     * [[Description]]
     * @param  [[Type]] [$modifiedTime = NULL] [[Description]]
     * @param  [[Type]] [$module = NULL]       [[Description]]
     * @return boolean  [[Description]]
     */
    public function entitiesSync($modifiedTime = NULL, $module = NULL)
    {
        // Perform re-login if required.
        $this->_checkLogin();
        if (empty($modifiedTime)) {
            $modifiedTime = strtotime('today midnight');
        }
        $reqdata = [
            'operation' => 'sync',
            'sessionName' => $this->_sessionName,
            'modifiedTime' => $modifiedTime
        ];
        if (!empty($module))
            $reqdata['elementType'] = $module;
        return $this->_sendRequest($reqdata, true);
    }
}
