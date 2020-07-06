<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($priority = null)
    {
        switch (request()->get('sortBy')) {
            case 'created':
                $sortBy = 'created_at';
                break;
            case 'completed':
                $sortBy = 'completed_at';
                break;
            case 'title':
                $sortBy = 'title';
                break;
            default:
                $sortBy = 'completed_at';
        }

        $sortOrder = request()->input('sortOrder') == 'asc'
            ? 'desc' : 'asc';

        if ($priority) {
            $tasks = Priority::where('name', $priority)->firstOrFail()
                ->tasks()->orderBy($sortBy, $sortOrder)->paginate();
        } else {
            $tasks = Task::orderBy($sortBy, $sortOrder)->paginate();
        }

        return view('tasks.index', [
            'tasks' => $tasks->appends(request()->except('page')),
            'sortOrder' => $sortOrder,
            'sortBy' => $sortBy
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = Priority::all();

        return view('tasks.create', compact('priorities'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        // Create Task
        $task = new Task;
        $task->title = $request->input('title');
        $task->user_id = auth()->id();

        if (request()->has('body')) {
            $task->body = $request->input('body');
        }

        $task->save();

        $task->priorities()->sync($request->input('priority'));


        return redirect('/tasks')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        $priorities = Priority::all();

        return view('tasks.edit', compact('priorities', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if (request()->has('completed')) {
            // we want to mark as incomplete
            if ($task->isCompleted) {
                $task->markAsIncomplete();
                return redirect(route('tasks.index'))->with('success', 'Task marked incomplete');
            }
            $task->markAsCompleted();
            return redirect(route('tasks.index'))->with('success', 'Task marked complete');
        }

        $this->validate($request, [
            'title' => 'required',
        ]);

        $task->update(request()->only([
            'title', 'body'
        ]));

        if ($request->has('priorities')) {
            $task->priorities()->sync(array_values($request->input('priorities')));
        }

        return redirect(route('tasks.show', $task))->with('success', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task Deleted');
    }
}
