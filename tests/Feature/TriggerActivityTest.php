<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use App\Task;


class TriggerActivityTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function creating_a_project() 
    {
        $project = app(ProjectFactory::class)
                    ->create();

        $this->assertCount(1, $project->activity);

        tap($project->activity->last(), function($activity) 
        {
            $this->assertEquals('project_created', $activity->description);
      
            $this->assertNull($activity->changes);
        });
    }


    /** @test */
    function updating_a_project() 
    {
        $project = app(ProjectFactory::class)->create();
        $originalTitle = $project->title;

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function($activity) use ($originalTitle) {
            $this->assertEquals('project_updated', $activity->description);

            $expected = [
                'before'    => ['title' => $originalTitle],
                'after'     => ['title' => 'changed']
            ];

            $this->assertEquals($expected, $activity->changes);

        });
    }


    /** @test */
    function creating_task() 
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)
                    ->create();

        $project->addTask('Some new task');

        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function($activity) {
            $this->assertEquals('task_created', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('Some new task', $activity->subject->body);
        });


        $this->assertEquals('task_created', $project->activity->last()->description);

    }

    /** @test */
    function completing_task() 
    {
        $project = app(ProjectFactory::class)
                    ->withTasks(1)
                    ->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body'      => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);


        tap($project->activity->last(), function($activity) {
            $this->assertEquals('task_completed', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });


        $this->assertEquals('task_completed', $project->activity->last()->description);

    }

    /** @test */
    function incompleting_task() 
    {
        $this->withoutExceptionHandling();

        $project = app(ProjectFactory::class)
                    ->withTasks(1)
                    ->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body'      => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);


        $this->patch($project->tasks[0]->path(), [
            'body'      => 'foobar',
            'completed' => false
        ]);


        $this->assertCount(4, $project->fresh()->activity);

        $this->assertEquals('task_incompleted', $project->fresh()->activity->last()->description);

    }

    /** @test */
    function deleting_task() 
    {
        $project = app(ProjectFactory::class)
                    ->withTasks(1)
                    ->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->fresh()->activity);
        $this->assertEquals('task_deleted', $project->fresh()->activity->last()->description);
   
    }

}
