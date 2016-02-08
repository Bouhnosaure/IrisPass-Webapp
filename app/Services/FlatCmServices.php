<?php

namespace App\Services;


use Illuminate\Filesystem\Filesystem;
use League\Flysystem\Adapter\Local;

class FlatCmServices
{
    public function __construct()
    {

    }

    public function process($identifier)
    {
        if ($this->checkExistance($identifier) === false) {
            $this->copyCMS($identifier);
            $this->sedReplace($identifier);
        } else {
            $this->reactivate($identifier);
        }

        return true;
    }

    /*
     * Step ONE
     */
    public function copyCMS($identifier)
    {
        //cd and git clone
        //exec('git clone'); ?

        $adapter = new Local('/var/www/cms_container');
        $filesystem = new Filesystem($adapter);
        $filesystem->createDir($identifier);

        $source = "/var/www/cms-master";
        $dest = "/var/www/cms_container/" . $identifier;

        $permissions = 0755;
        $this->xcopy($source, $dest, $permissions);

        exec('chmod -R 777 ' . $dest);
        exec('chown -R www-data:www-data ' . $dest);
    }

    /*
     * Step Three
     */
    public function sedReplace($identifier)
    {
        $target_db = 'crm' . $identifier;
        $target_db = str_replace('-', '', $target_db);
        $path_to_directory = '/var/www/cms_container/' . $identifier . '/';
        $path_to_file = $path_to_directory . 'config.inc.php';

        $file_contents = file_get_contents($path_to_file);

        $file_contents = str_replace('$dbconfig[\'db_name\'] = \'crmmasterdb\'', '$dbconfig[\'db_name\'] = \'' . $target_db . '\'', $file_contents);
        $file_contents = str_replace('$site_URL = \'http://master.bziiit.com/\'', '$site_URL = \'http://' . $identifier . '.crm.bziiit.com/\'', $file_contents);
        $file_contents = str_replace('$root_directory = \'/var/www/crm-master-00/\'', '$root_directory = \'' . $path_to_directory . '\'', $file_contents);

        file_put_contents($path_to_file, $file_contents);
    }

    /*
     * DISABLE
     */
    public function disable($identifier)
    {
        $adapter = new Local('/var/www/cms_container');
        $filesystem = new Filesystem($adapter);
        $filesystem->createDir('disabled');
        if ($this->checkExistance($identifier) === true && is_dir('/var/www/cms_container/' . $identifier)) {
            exec('mv /var/www/cms_container/' . $identifier . ' /var/www/cms_container/disabled/');
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

        if ($this->checkExistance($identifier) === true) {
            exec('mv /var/www/cms_container/disabled/' . $identifier . ' /var/www/cms_container/');
            return true;
        } else {
            return 'error';
        }

    }

    public function checkExistance($identifier)
    {
        $exists = false;
        $adapter = new Local('/var/www/cms_container');
        $filesystem = new Filesystem($adapter);
        $contents = $filesystem->listContents('/');
        foreach ($contents as $directory) {
            if ($directory['basename'] == $identifier) {
                $exists = true;
                return $exists;
            }
        }

        $adapter = new Local('/var/www/cms_container/disabled');
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

    public function isActive($identifier)
    {
        $exists = false;
        $adapter = new Local('/var/www/cms_container');
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