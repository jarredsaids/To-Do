<?php

namespace App\Http\Controllers;

use App\PList;
use Illuminate\Http\Request;

class PListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $title, $priority)
    {
        $plistAll = PList::all();
        $found = FALSE;
        foreach($plistAll as $entry){
            if ($entry->task_id == $id && $entry->priority == $priority){
                $found = TRUE;
            }
        }
        if ($found == FALSE) {
            $plist = new PList();
            $plist->task_id = $id;
            $plist->title = $title;
            $plist->priority = $priority;
            $plist->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $priority)
    {

        $plistAll = PList::all();
        $found = FALSE;
        foreach($plistAll as $entry){
            if ($entry->task_id == $id && $entry->priority == $priority){

                $plist = PList::find($entry->id);
                $plist->delete();
            }
        }
    }
}
