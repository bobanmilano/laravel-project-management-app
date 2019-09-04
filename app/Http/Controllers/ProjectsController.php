<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Project;


class ProjectsController extends Controller
{
    

    public function index() 
    {
		$projects = auth()->user()->projects; //Project::all();

		return view('projects.index', compact('projects'));
    }



    public function show(Project $project) 
    {
        
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }


    public function edit(Project $project) 
    {
        return view('projects.edit', compact('project'));

    }



    public function store() 
    {

    	$attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required|max:100',
            'notes'     => 'min:3'
        ]);

        //dd($attributes);

        $attributes['owner_id'] = auth()->id();
        $project = auth()->user()->projects()->create($attributes);

		return redirect($project->path());
    }



    public function create() 
    {
        return view('projects.create');
    }



    public function update(Project $project) 
    {

        $this->authorize('update', $project);

        $attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required|max:100',
            'notes'     => 'min:3'
            ]);


        $project->update($attributes);

        return redirect($project->path());

    }






}
