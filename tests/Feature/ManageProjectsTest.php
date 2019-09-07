<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use Tests\Setup\ProjectFactory;


class ManageProjectsTest extends TestCase
{


    use WithFaker, RefreshDatabase;


    /** @test */
    public function guests_cannot_manage_projects()
    {
         
        $project = factory('App\Project')->create(); 

        $this->get('/projects')->assertRedirect('login'); 
        $this->get('/projects/create')->assertRedirect('login'); 
        $this->get($project->path() . '/edit')->assertRedirect('login'); 
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');   
        
    }



    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title'         => 'Test Project',
            'description'   => 'Description for Test Project',
            'notes'         => 'notes for Test Project',
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->get();        

        $response->assertRedirect($project->path());

        $this->get($project->path())
                ->assertSee($attributes['title'])
                ->assertSee($attributes['notes'])
                ->assertSee($attributes['description']);

    }



    /** @test */
    public function a_user_can_update_a_project() 
    {      
  
        $project = app(ProjectFactory::class)
                    ->create();

        $this->actingAs($project->owner)
            ->patch($project->path(), ['title' => 'changed', 'description' => 'changed', 'notes'     => 'changed'])
            ->assertRedirect($project->path());


        $this->get($project->path() . '/edit')->assertOk();    

        $this->assertDatabaseHas('projects', ['notes' => 'changed']);

    }



    /** @test */
    public function a_user_can_update_a_projects_notes() 
    {
        $project = app(ProjectFactory::class)
                    ->create();

        $this->actingAs($project->owner)
            ->patch($project->path(), ['notes'     => 'changed']);  

        $this->assertDatabaseHas('projects', ['notes' => 'changed']);
    }



    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others() 
    {
        $this->signIn();
        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create(); 

        $this->patch($project->path())->assertStatus(403);     
    } 


    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others() 
    {
        $this->signIn();
        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create(); 

        $this->get($project->path())->assertStatus(403);     
    }   


    /** @test */
    public function a_user_can_view_their_project() 
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)
                    ->create(); 
               
        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);      
    }    


    /** @test */
    public function a_project_requires_a_title() 
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);


        $this->post('/projects', $attributes)->assertSessionHasErrors('title');   
    }


    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();
        
        $attributes = factory('App\Project')->raw(['description' => '']);
        
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');   
    }







}
