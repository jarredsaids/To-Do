<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //The site's Index page
    public function index(){
        $title = 'Welcome to To-Do';
        return view('pages.index')->with('title', $title);
    }

    //The site's About page
    public function about(){
        $title = 'About To-Do';
        return view('pages.about')->with('title', $title);
    }

    //The site's main Task page
    public function tasks()
    {
        $title = 'Task List';
        return view('pages.tasks')->with('title', $title);
    }
    //The site's Task View page
    public function task()
    {
        $title = 'Task View';
        return view('pages.task')->with('title', $title);
    }

    //The site's Task Edit page
    public function edit(){
        $title = 'Edit Task';
        return view('pages.edit')->with('title', $title);
    }
}
