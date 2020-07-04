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

/*      //Sort by title [Ascending]
 *      $tasks =  Task::orderBy('title','asc')->get();
 */

/*      //Sort by title [Descending]
 *      $tasks =  Task::orderBy('title','desc')->get();
 */

/*        //Return specific task
 *      $task = Task::where('title, 'Task __')0>get();
 */

        //$tasks = 2D array of all saved tasks
        //$tasks =  Task::all();
        $tasks =  Task::orderBy('title', 'desc')->paginate(8);
        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['priorities'] = Priority::all();
        return view('tasks.create', ['data'=>$data]);

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
           'body' => 'required',
        ]);

        // Create Task
        $task = new Task;
        $task->title = $request->input('title');
        $task->body = $request->input('body');
        $task->completed = FALSE;
        $task->save();

        //Process and store the priorities
        $data['priorities'] = Priority::all();
        foreach ($data['priorities'] as $p) {
            if ($request->input($p->p_type) == TRUE){
                $plist = new PListsController();
                $plist->task_id = $task->id;
                $plist->title = $task->title;
                $plist->priority = $request->input($p->p_type);
                $plist->update($plist->task_id, $plist->title, $plist->priority);
            }else{
                $plist = new PListsController();
                $plist->task_id = $request->input('id');
                $plist->title = $request->input('title');
                $plist->priority = $request->input($p->p_type);
                $plist->destroy($plist->task_id, $plist->priority);
            }

        }
         return redirect('/tasks')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['task'] = Task::find($id);
        $data['priorities'] = Priority::all();
          return view('tasks.edit', ['data'=>$data]);
        //return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $task = Task::find($id);
        $task->title = $request->input('title');
        $task->body = $request->input('body');
        $task->completeddate = $request->input('completeddate');
        //NEEDS PRIORITIES TO BE PROCESSED!


        $task->completed = $request->input('completed');
        if ($task->completed == NULL){
            $task->completed = FALSE;
        }

        $task->save();

        return redirect('/tasks')->with('success', 'Task Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/tasks')->with('success', 'Task Deleted');
    }



}
