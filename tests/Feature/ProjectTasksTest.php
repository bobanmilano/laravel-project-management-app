<?php

namespace Tests\Feature;

use Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;



class ProjectTasksTest extends TestCase
{
    
    use RefreshDatabase, WithFaker;

    /** @test */
    public function guests_cannot_add_tasks_to_projects() 
    {
        $project = factory('App\Project')->create();

        $this->post($project->path() . "/tasks")->assertRedirect("login");
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks() 
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . "/tasks", ['body' => "Test task"])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

       /** @test */
    public function only_the_owner_of_a_project_may_update_a_task() 
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $task = $project->addTask("A new test task");


        $this->patch($task->path(), ['body' => "changed"])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }



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
    public function a_task_can_be_updated() 
    {
       


        $project = app(ProjectFactory::class)
                    ->withTasks(1)
                    ->create();


        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body'          => 'changed',
                'completed'     => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body'  => 'changed',
            'completed' => true
        ]);
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
