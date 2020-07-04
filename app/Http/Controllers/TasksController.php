<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //       dd(request()->input());

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
            case 'priority':
                $sortBy = 'priority';
                break;
            default:
                $sortBy = 'created_at';
        }

        $sortOrder = (request()->get('sortOrder') == 'ascending')
            ? 'asc'
            : 'desc';


        $tasks = Task::orderBy('created_at', $sortOrder)->paginate(8);

        return view('tasks.index')->with('tasks', $tasks);
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
        $task = Task::find($id);
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
        $data['task'] = Task::find($id);
        $data['priorities'] = Priority::all();
        return view('tasks.edit', ['data' => $data]);
        //return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $task = Task::find($id);
        $task->title = $request->input('title');
        $task->body = $request->input('body');
        $task->completed_at = now();


        $task->save();

        //if request from Tasks Index View (toggle complete), skip this
        if (($request->input('_method')) != "PATCH") {
            //Process and store the priorities
            $data['priorities'] = Priority::all();
            $plist = new PListsController();
            $plist->task_id = $task->id;
            $plist->title = $task->title;

            foreach ($data['priorities'] as $p) {
                $p_string = "priority-" . $p->p_type;
                if ($request->input($p_string) == TRUE) {
                    $plist->priority = $request->input($p_string);
                    $plist->update($plist->task_id, $plist->title, $plist->priority);
                } else {
                    $plist->priority = $p->p_type;
                    $plist->destroy($plist->task_id, $plist->priority);
                }
            }
        }
        return redirect('/tasks')->with('success', 'Task Updated');

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
