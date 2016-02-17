<?php namespace App\Repositories\Eloquent;

use App\Repositories\WebsiteRepositoryInterface;
use App\Website;

class WebsiteRepository implements WebsiteRepositoryInterface
{
    /**
     * @var Event
     */
    private $model;

    /**
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        $this->model = $website;
    }


    /**
     * get all $website
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get all $website in a list for a select box
     * @return mixed
     */
    public function getList()
    {
        return $this->model->latest('created_at')->lists('identifier', 'id');
    }

    /**
     * get $website by id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * create a new $website
     * @param array $data
     * @return static
     */
    public function create(Array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update an $website
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, Array $data)
    {
        $website = $this->model->findOrFail($id)->update($data);

        return $website;
    }

    /**
     * delete a $website
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * get all $website in paginated list
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->latest('created_at')->paginate($number);
    }
}
