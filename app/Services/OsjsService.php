<?php namespace App\Services;

use Illuminate\Support\Facades\Storage;

class OsjsService
{

    private $disk;

    private $users_directory;

    private $groups_directory;

    private $is_testing;

    public function __construct()
    {
        $this->disk = Storage::disk('osjs');
        $this->users_directory = 'home';
        $this->groups_directory = 'groups';

        $this->is_testing = (env('APP_ENV') == 'testing') ? true : false;
    }

    public function createUserDirectory($username)
    {

        $path = $this->users_directory . DIRECTORY_SEPARATOR . $username;

        if ($this->disk->makeDirectory($path, false, $this->is_testing)) {
            return $path;
        }

        return null;

    }

    public function createGroupDirectory($group_name)
    {
        $path = $this->groups_directory . DIRECTORY_SEPARATOR . $group_name;

        if ($this->disk->makeDirectory($path, false, $this->is_testing)) {
            return $path;
        }

        return null;
    }
}
