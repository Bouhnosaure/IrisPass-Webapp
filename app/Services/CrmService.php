<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 15/10/2015
 * Time: 22:11
 */

namespace App\Services;


use App\Services\Vtiger\VtigerClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class CrmService
{

    public function process($identifier)
    {

        if ($this->checkExistance($identifier) === false) {
            $this->copyCrm($identifier);
            $this->copyDatabase($identifier);
            $this->sedReplace($identifier);
        } else {
            $this->reactivate($identifier);
        }

        return true;
    }

    /*
     * Step ONE
     */
    public function copyCrm($identifier)
    {

        $adapter = new Local('/var/www/crm_container');
        $filesystem = new Filesystem($adapter);
        $filesystem->createDir($identifier);

        $source = "/var/www/crm-master-00";
        $dest = "/var/www/crm_container/" . $identifier;
        $permissions = 0755;

        $this->xcopy($source, $dest, $permissions);

        exec('chmod -R 777 ' . $dest);
        exec('chown -R www-data:www-data ' . $dest);
    }


    /*
     * Step TWO
     */
    public function copyDatabase($identifier)
    {

        $user = 'revive';
        $pwd = 'ZZdue2MZDrf7hfam';
        $source_db = 'crmmasterdb';
        $target_db = 'crm' . $identifier;
        $target_db = str_replace('-', '', $target_db);

        $command = 'echo "create database ' . $target_db . '" | mysql -h mysql-master -u' . $user . ' -p' . $pwd;
        exec($command);

        $command = 'mysqldump -h mysql-master -u' . $user . ' -p' . $pwd . ' ' . $source_db . ' | mysql -h mysql-master -u' . $user . ' -p' . $pwd . ' ' . $target_db;
        exec($command);

    }

    /*
     * Step Three
     */
    public function sedReplace($identifier)
    {

        $target_db = 'crm' . $identifier;
        $target_db = str_replace('-', '', $target_db);

        $path_to_directory = '/var/www/crm_container/' . $identifier . '/';
        $path_to_file = $path_to_directory . 'config.inc.php';
        $file_contents = file_get_contents($path_to_file);

        $file_contents = str_replace('$dbconfig[\'db_name\'] = \'crmmasterdb\'', '$dbconfig[\'db_name\'] = \'' . $target_db . '\'', $file_contents);
        $file_contents = str_replace('$site_URL = \'http://master.bziiit.com/\'', '$site_URL = \'http://' . $identifier . '.crm.bziiit.com/\'', $file_contents);
        $file_contents = str_replace('$root_directory = \'/var/www/crm-master-00/\'', '$root_directory = \'' . $path_to_directory . '\'', $file_contents);
        file_put_contents($path_to_file, $file_contents);
    }

    /*
     * Final Step
     */
    public function createUser($identifier, $user_data)
    {
        $client = new VtigerClient('http://' . $identifier . '.crm.bziiit.com');
        $login = $client->login('admin', 'W6zx4j1xNIgqRoi6');

        $userData = Array(
            'user_name' => array_get($user_data, 'user_name'),
            'user_password' => array_get($user_data, 'password'),
            'confirm_password' => array_get($user_data, 'password_confirm'),
            'first_name' => array_get($user_data, 'first_name'),
            'last_name' => array_get($user_data, 'last_name'),
            'email1' => array_get($user_data, 'email'),
            'roleid' => array_get($user_data, 'role_id'),
            'status' => 'Active'
        );

        $defaultData = Array(
            'is_admin' => 'off',
            'title' => '',
            'department' => '',
            'phone_home' => '',
            'phone_mobile' => '',
            'phone_work' => '',
            'address_street' => '',
            'address_city' => '',
            'address_state' => '',
            'address_country' => '',
            'address_postalcode' => '',
            'date_format' => 'dd-mm-yyyy',
            'hour_format' => '24',
            'lead_view' => 'Today',
            'internal_mailer' => '1',
            'reminder_interval' => '1 Minute',
            'theme' => 'nature',
            'language' => 'fr_fr',
            'time_zone' => 'Europe/Paris',
            'currency_grouping_pattern' => '123,456,789',
            'currency_symbol_placement' => '1.0$',
            'no_of_currency_decimals' => '2',
            'truncate_trailing_zeros' => '1',
            'dayoftheweek' => 'Monday',
            'rowheight' => 'narrow',
            'defaulteventstatus' => 'Select an Option',
            'defaultactivitytype' => 'Select an Option',
            'is_owner' => '0'
        );

        $allUserData = array_merge($userData, $defaultData);

        return $client->entityCreate('Users', $allUserData);
    }

    /*
     * DISABLE
     */
    public function disable($identifier)
    {
        $adapter = new Local('/var/www/crm_container');
        $filesystem = new Filesystem($adapter);
        $filesystem->createDir('disabled');


        if ($this->checkExistance($identifier) === true && is_dir('/var/www/crm_container/' . $identifier)) {
            exec('mv /var/www/crm_container/' . $identifier . ' /var/www/crm_container/disabled/');
            return true;
        } else {
            return 'error';
        }
    }

    /*
     * Helpers
     */
    public function reactivate($identifier)
    {
        $adapter = new Local('/var/www/crm_container');
        $filesystem = new Filesystem($adapter);
        $filesystem->createDir('disabled');


        if ($this->checkExistance($identifier) === true) {
            exec('mv /var/www/crm_container/disabled/' . $identifier . ' /var/www/crm_container/');
            return true;
        } else {
            return 'error';
        }
    }

    public function checkExistance($identifier)
    {
        $exists = false;

        $adapter = new Local('/var/www/crm_container');
        $filesystem = new Filesystem($adapter);
        $contents = $filesystem->listContents('/');

        foreach ($contents as $directory) {
            if ($directory['basename'] == $identifier) {
                $exists = true;
                return $exists;
            }
        }

        $adapter = new Local('/var/www/crm_container/disabled');
        $filesystem = new Filesystem($adapter);
        $contents = $filesystem->listContents('/');

        foreach ($contents as $directory) {
            if ($directory['basename'] == $identifier) {
                $exists = true;
                return $exists;
            }
        }

        return $exists;
    }

    public function getUsers($identifier)
    {
        $target_db = 'crm' . $identifier;
        $target_db = str_replace('-', '', $target_db);

        Config::set('database.connections.mysql-crm.database', $target_db);
        $db = DB::connection('mysql-crm');

        $users = $db->table('vtiger_users')->select('id', 'user_name', 'first_name', 'last_name', 'email1', 'status')->where('id', '!=', 1)->get();

        return $users;

    }


    public function toogleUserCRM($identifier, $user_id)
    {
        $target_db = 'crm' . $identifier;
        $target_db = str_replace('-', '', $target_db);
        Config::set('database.connections.mysql-crm.database', $target_db);
        $db = DB::connection('mysql-crm');

        $user = $db->table('vtiger_users')->where('id', $user_id)->first();

        if ($user->status == "Active") {
            $db->table('vtiger_users')->where('id', $user_id)->update(array('status' => 'Inactive'));
        } else {
            $db->table('vtiger_users')->where('id', $user_id)->update(array('status' => 'Active'));
        }

        return true;
    }

    public function isActive($identifier)
    {
        $exists = false;

        $adapter = new Local('/var/www/crm_container');
        $filesystem = new Filesystem($adapter);
        $contents = $filesystem->listContents('/');

        foreach ($contents as $directory) {
            if ($directory['basename'] == $identifier) {
                $exists = true;
                return $exists;
            }
        }

        return $exists;
    }

    public function xcopy($source, $dest, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            $this->xcopy("$source/$entry", "$dest/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }

}