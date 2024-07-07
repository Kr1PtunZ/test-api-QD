<?php

namespace App\Interfaces;

interface TasksRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function getTaskByDeadline(string $deadline);
    public function getByStatus($status);
}
