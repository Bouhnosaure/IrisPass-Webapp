<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 18/10/2015
 * Time: 22:38
 */

namespace App\Services\Vtiger;


class VtigerUtils
{
    /**
     * Gets actual record ID from the response ID
     * @param  [[Type]] $id [[Description]]
     * @return int [[Type]] [[Description]]
     */
    public static function getRecordID($id)
    {
        $ex = explode('x', $id, 2);
        return (count($ex) !== 2)
            ? -1
            : $ex[1];
    }

    /**
     * Gets target URL for WebServices API requests
     * @param  string $url [[Description]]
     * @return string The complete URL of the service
     */
    public static function getServiceURL($url)
    {
        if (strripos($url, 'http://', -strlen($url)) === FALSE) {
            $url = 'http://' . $url;
        }
        if (strripos($url, '/') != (strlen($url) - 1)) {
            $url .= '/';
        }
        return $url;
    }
}