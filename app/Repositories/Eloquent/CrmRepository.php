<?php namespace App\Repositories\Eloquent;

use App\Crm;
use App\Repositories\CrmRepositoryInterface;

class CrmRepository implements CrmRepositoryInterface
{
    /**
     * @var Event
     */
    private $model;

    /**
     * @param Website $crm
     */
    public function __construct(Crm $crm)
    {
        $this->model = $crm;
    }


    /**
     * get all $crm
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get all $crm in a list for a select box
     * @return mixed
     */
    public function getList()
    {
        return $this->model->latest('created_at')->lists('identifier', 'id');
    }

    /**
     * get $crm by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * create a new $crm
     * @param array $data
     * @return static
     */
    public function create(Array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update an $crm
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {
        $crm = $this->model->findOrFail($id)->update($data);

        return $crm;
    }

    /**
     * delete a $crm
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * get all $crm in paginated list
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->latest('created_at')->paginate($number);
    }
}
