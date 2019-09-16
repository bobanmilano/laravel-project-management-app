<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\User;
use Tests\Setup\ProjectFactory;

class ProjectTest extends TestCase
{
    
    use RefreshDatabase;


    /** @test */
    public function it_has_a_path() 
    {
    	$project = factory('App\Project')->create();   
    	 	
    	$this->assertEquals('/projects/' . $project->id, $project->path());
    }


    /** @test */
    public function it_belongs_to_an_owner() 
    {
    	$project = factory('App\Project')->create();   

    	$this->assertInstanceOf('App\User', $project->owner);
    }


    /** @test */
    public function it_can_add_a_task() 
    {
        $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();

        $task = $project->addTask('Test task');

        $this->assertTrue($project->tasks->contains($task));

    }


    /** @test */
    public function it_can_invite_a_user() 
    {
        //having a project
        $project = app(ProjectFactory::class)
                    ->create();

        //this project can invite another user
        $project->invite($user = factory(User::class)->create());            

        $this->assertTrue($project->members->contains($user));

    }

}
