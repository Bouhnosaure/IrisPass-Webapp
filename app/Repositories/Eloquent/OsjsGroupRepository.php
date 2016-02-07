<?php namespace App\Repositories\Eloquent;

use App\Event;
use App\OsjsGroup;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\OsjsUser;

class OsjsGroupRepository implements OsjsGroupRepositoryInterface
{
    /**
     * @var Event
     */
    private $model;

    /**
     * @param OsjsGroup $group
     */
    public function __construct(OsjsGroup $group)
    {
        $this->model = $group;
    }


    /**
     * get all OsjsGroup
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get all OsjsGroup in a list for a select box
     * @return mixed
     */
    public function getList()
    {
        return $this->model->latest('created_at')->lists('name', 'id');
    }

    /**
     * get OsjsGroup by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * create a new OsjsGroup
     * @param array $data
     * @return static
     */
    public function create(Array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update an OsjsGroup
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {
        $group = $this->model->findOrFail($id)->update($data);

        return $group;
    }

    /**
     * delete a OsjsGroup
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * get all OsjsGroup in paginated list
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->latest('created_at')->paginate($number);
    }
}
