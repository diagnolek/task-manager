<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected string $routeToList = 'task.manage';

    private array $rule = [
        'title'=>'required|min:1|max:255'
    ];

    private function activeTasks(): Builder
    {
        return Task::where('is_delete', false);
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $token = session('token')[0]??'';
        return view('pages.task.dashboard', compact('token'));
    }

    public function tasks()
    {
        return $this->activeTasks()->whereNull('done')->orderBy('created_at', 'ASC')->get();
    }

    public function tasksDone()
    {
        return $this->activeTasks()->whereNotNull('done')->orderBy('done', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rule);

        Task::create($data);

        return ['message' => 'success'];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $action = $request->get('action');
        $updated = null;
        switch($action)
        {
            case 'done':
                $updated = $task->update(['done'=> new \DateTime()]);
                break;
            case 'cancel':
                $updated = $task->update(['done'=>null]);
                break;
            case 'title':
                $fields = $request->validate($this->rule);
                $updated = $task->update(array_map('trim',$fields));
                break;
        }

        return ['message' => 'updated: ' . $updated];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $deleted = Task::findOrFail($id)->update(['is_delete'=>1]);
        return ['message' => 'deleted: ' . $deleted];
    }
}
