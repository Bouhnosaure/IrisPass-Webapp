<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 09/05/2015
 * Time: 22:31
 */

namespace App\Repositories;

use App\User;

interface UserConfirmationRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getByUser(User $user);

    public function getByConfirmationCode($code);

    public function create(User $user, $type);

    public function clear(User $user, $type);

    public function update($id, Array $data);

    public function delete($id);

    public function paginate($number);
}
