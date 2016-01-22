<?php namespace App\Repositories\Eloquent;

use App\Event;
use App\Repositories\OsjsUserRepositoryInterface;
use App\OsjsUser;

class OsjsUserRepository implements OsjsUserRepositoryInterface
{
    /**
     * @var Event
     */
    private $model;

    /**
     * @param OsjsUser $user
     */
    public function __construct(OsjsUser $user)
    {
        $this->model = $user;
    }


    /**
     * get all OsjsUser
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get all OsjsUser in a list for a select box
     * @return mixed
     */
    public function getList()
    {
        return $this->model->latest('created_at')->lists('username', 'id');
    }

    /**
     * get OsjsUser by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * create a new OsjsUser
     * @param array $data
     * @return static
     */
    public function create(Array $data)
    {

        $data['password'] = bcrypt($data['password']);
        $data['groups'] = '["api","application","vfs","upload","curl"]';

        return $this->model->create($data);
    }

    /**
     * update an OsjsUser
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->model->findOrFail($id)->update($data);

        return $user;
    }

    /**
     * delete a OsjsUser
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * get all OsjsUser in paginated list
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->latest('created_at')->paginate($number);
    }
}
