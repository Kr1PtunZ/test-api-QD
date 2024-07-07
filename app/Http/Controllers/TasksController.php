<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Interfaces\TasksRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{

    private TasksRepositoryInterface $tasksRepositoryInterface;

    public function __construct(TasksRepositoryInterface $tasksRepositoryInterface)
    {
        $this->tasksRepositoryInterface = $tasksRepositoryInterface;
    }

    public function index()
    {
        $data = $this->tasksRepositoryInterface->index();

        return ApiResponseClass::sendResponse(TaskResource::collection($data), '', 200);
    }

    public function store(StoreTasksRequest $request)
    {
        $taskInfo = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'deadline' => $request->deadline
        ];
        DB::beginTransaction();
        try {
            $task = $this->tasksRepositoryInterface->store($taskInfo);

            DB::commit();
            return ApiResponseClass::sendResponse(new TaskResource($task), 'Success', 201);

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = $this->tasksRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new TaskResource($task), '', 200);
    }

    public function update(UpdateTasksRequest $request, $id)
    {
        $updateInfo = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ];
        DB::beginTransaction();
        try {
            $product = $this->tasksRepositoryInterface->update($updateInfo, $id);

            DB::commit();
            return ApiResponseClass::sendResponse('Success', 'Updated', 201);

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->tasksRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Success', 'Deleted', 204);
    }

    public function getTaskByDeadline($deadline)
    {

        $tasks = $this->tasksRepositoryInterface->getTaskByDeadline($deadline);

        if ($tasks === null) {
            return ApiResponseClass::sendResponse(null, 'No tasks', '404');
        }

        return ApiResponseClass::sendResponse(TaskResource::collection($tasks), '', 200);

    }

    /**
     * Get tasks by status.
     */
    public function getByStatus($status)
    {
        $tasks = $this->tasksRepositoryInterface->getTaskByDeadline($status);

        if ($tasks === null) {
            return ApiResponseClass::sendResponse(null, 'No tasks', '404');
        }

        return ApiResponseClass::sendResponse(TaskResource::collection($tasks), '', 200);

    }
}
