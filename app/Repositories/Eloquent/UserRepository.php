<?php namespace App\Repositories\Eloquent;

use App\Event;
use App\Repositories\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Event
     */
    private $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }


    /**
     * get all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get all users in a list for a select box
     * @return mixed
     */
    public function getList()
    {
        return $this->model->latest('created_at')->lists('name', 'id');
    }

    /**
     * get user by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->with('profile')->findOrFail($id);
    }

    /**
     * create a new user
     * @param array $data
     * @return static
     */
    public function create(Array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update an user
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {
        $user = $this->model->findOrFail($id)->update($data);

        if (isset($data['profile'])) {
            $this->model->findOrFail($id)->profile()->update($data['profile']);
        }

        return $user;
    }

    /**
     * delete a user
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->with('profile')->findOrFail($id)->delete();
    }

    /**
     * get all user in paginated list
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->with('profile')->latest('created_at')->paginate($number);
    }
}
