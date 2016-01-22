<?php namespace App\Services;

use Illuminate\Support\Facades\Storage;

class OsjsService
{
    /**
     * @var directory
     */
    protected $vfs_path;

    protected $users_directory;

    protected $groups_directory;

    public function __construct()
    {
        $this->vfs_path = config('osjs.vfs_path');
        $this->users_directory = $this->vfs_path . DIRECTORY_SEPARATOR . 'home';
        $this->groups_directory = $this->vfs_path . DIRECTORY_SEPARATOR . 'groups';
    }

    public function createUserDirectory($username)
    {
        $path = $this->users_directory . DIRECTORY_SEPARATOR . $username;

        if (mkdir($path, 0755, false)) {
            return $path;
        }

        return null;

    }

    public function createGroupDirectory($group_name)
    {
        $path = $this->groups_directory . DIRECTORY_SEPARATOR . $group_name;

        if (mkdir($path, 0755, false)) {
            return $path;
        }

        return null;
    }
}
