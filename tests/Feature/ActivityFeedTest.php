<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;

class ActivityFeedTest extends TestCase
{


    use RefreshDatabase;


    /** @test */
    function creating_a_project_generates_activity() 
    {
        $project = app(ProjectFactory::class)
                    ->create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('a new project created', $project->activity[0]->description);
    }


    /** @test */
    function updating_a_project_generates_activity() 
    {
        $project = app(ProjectFactory::class)->create();

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        $this->assertEquals('project updated', $project->activity->last()->description);
    }

}
