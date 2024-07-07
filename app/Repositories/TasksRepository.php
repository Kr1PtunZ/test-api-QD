<?php

namespace App\Repositories;

use App\Interfaces\TasksRepositoryInterface;
use App\Models\Tasks;
use Illuminate\Support\Collection;

class TasksRepository implements TasksRepositoryInterface
{
    public function index()
    {
        return Tasks::all();
    }

    public function getById($id)
    {
        return Tasks::findOrFail($id);
    }

    public function store(array $data)
    {
        return Tasks::create($data);
    }

    public function update(array $data, $id)
    {
        return Tasks::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Tasks::destroy($id);
    }

    public function getTaskByDeadline($deadline)
    {
       return Tasks::getByDeadline($deadline);
    }

    public function getByStatus($status)
    {
       return Tasks::getByStatus($status);
    }
}
