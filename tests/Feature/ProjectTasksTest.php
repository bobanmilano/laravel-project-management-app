<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;



class ProjectTasksTest extends TestCase
{
    
    use RefreshDatabase, WithFaker;


    /** @test */
    public function a_project_can_have_tasks() 
    {
        //$this->withoutExceptionHandling();

        $this->signIn();

        //create project
        $project = factory(Project::class)->raw();

        $project = auth()->user()->projects()->create($project);
     
        //trigger the endpoint for adding a task to the project
        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        //now assert that the project has the added task
        $this->get($project->path())
            ->assertSee('Test Task');
    }


    /** @test */
    public function a_task_requires_a_body() 
    {
        
        $this->signIn();



        $project = auth()->user()->projects()->create(factory(Project::class)->raw());
        
        $attributes = factory('App\Task')->raw(['body' => '']);
        
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');  

    }

}
