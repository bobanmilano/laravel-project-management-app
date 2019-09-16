<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ActivityTest extends TestCase
{
    
    use RefreshDatabase;


    /** @test **/
    function it_has_a_user() 
    {
    	$this->signIn();
    	$project = factory(Project::class)->create();

    	$this->assertInstanceOf(User::class, $project->activity->first()->user);
    }


}



