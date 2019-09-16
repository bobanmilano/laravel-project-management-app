<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use App\User;


class UserTest extends TestCase
{


	use RefreshDatabase;

	
    /** @test */ 
    public function has_projects()
    {
    	$user = factory('App\User')->create();

    	$this->assertInstanceOf(Collection::class, $user->projects);
       
    }


    /** @test */ 
    public function has_accessible_projects()
    {
    	$user_john = $this->signIn();

    	$project = ProjectFactory::ownedBy($user_john)->create();

    	$this->assertCount(1, $user_john->accessibleProjects());

    	$user_sally = factory(User::class)->create();
    	$user_jimbo = factory(User::class)->create();

    	$project_2 = ProjectFactory::ownedBy($user_sally)->create();
    	$project_2->invite($user_jimbo);

    	$this->assertCount(1, $user_john->accessibleProjects());

    	$project_2->invite($user_john);

		$this->assertCount(2, $user_john->accessibleProjects());
       
    }


}
