<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 09/05/2015
 * Time: 22:37
 */

namespace App\Repositories\Eloquent;

use App\Repositories\UserConfirmationRepositoryInterface;
use App\User;
use App\UserConfirmation;

class UserConfirmationRepository implements UserConfirmationRepositoryInterface
{
    private $model;

    public function __construct(UserConfirmation $userConfirmation)
    {
        $this->model = $userConfirmation;
    }

    /**
     * get all confirmations codes
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get confirmation code by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * get confirmations code by id
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getByUser(User $user)
    {
        return $user->confirmations()->getResults();
    }

    /**
     * get confirmation code by code
     * @param $code
     * @return mixed
     */
    public function getByConfirmationCode($code)
    {
        return $this->model->where('confirmation_code', '=', $code)->first();
    }

    /**
     * Create a confirmation code by type and user like sms or mail
     * @param User $user
     * @param $type
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(User $user, $type)
    {
        switch ($type) {
            case 'mail':
                return $user->confirmations()->create(['type' => 'mail', 'confirmation_code' => str_random(30)]);
                break;
            case 'phone':
                return $user->confirmations()->create(['type' => 'phone', 'confirmation_code' => rand(1000, 9999)]);
                break;
        }
    }

    /**
     * Clean a entry
     * @param User $user
     * @param $type
     */
    public function clear(User $user, $type)
    {
        return $user->confirmations()->where('type', '=', $type)->delete();
    }

    /**
     * update a confirmation code
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    /**
     * delete a confirmation code
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * return list of paginated content of code
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->latest('created_at')->paginate($number);
    }
}
