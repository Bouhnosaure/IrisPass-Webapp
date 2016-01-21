<?php namespace App\Repositories;

interface OrganizationRepositoryInterface
{
    public function getAll();

    public function getList();

    public function getById($id);

    public function create(Array $data);

    public function update($id, Array $data);

    public function delete($id);

    public function paginate($number);
}
