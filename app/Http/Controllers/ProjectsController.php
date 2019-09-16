<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest; 
use App\Project;



class ProjectsController extends Controller
{
    

    public function index() 
    {
		$projects = auth()->user()->accessibleProjects(); 


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


    public function destroy(Project $project) 
    {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
    }


    protected function validateRequest() 
    {
        $attributes = request()->validate([
            'title' => 'sometimes|required', 
            'description' => 'sometimes|required',
            'notes' => 'nullable'
            ]);

        return $attributes;
    }


    public function store() 
    {        
        $attributes = $this->validateRequest();
        $attributes['owner_id'] = auth()->id();
      
        $project = Project::create($attributes);
      
		return redirect($project->path());
    }


    public function create() 
    {
        return view('projects.create');
    }


    public function update(UpdateProjectRequest $request, Project $project) 
    {
        $request->persist();
        
        return redirect($project->path());
    }


}
