<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\User;

use Tests\Setup\ProjectFactory;


class InvitationsTest extends TestCase
{

    use RefreshDatabase;


    /** @test **/
    function non_owners_may_not_invite_users()  
    {
         
        //$this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)
                    ->create();

        $user = factory(User::class)->create();

        $assertInvitationForbidden = function() use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();

    }


    /** @test **/
    function email_address_must_be_associated_with_a_valid_birdboard_account() 
    {

        $project = app(ProjectFactory::class)
                    ->create();
 
        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                    'email' => 'unknownuser@example.com'
        ])

            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a valid account!'
        ], null, 'invitations');
    }


    /** @test **/
    function a_project_owner_can_invite_a_user() 
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create(); 
        $user = factory(User::class)->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $user->email
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($user));
    }


    /** @test **/
    function invited_users_may_update_project_details() {
        //having a project
        $project = app(ProjectFactory::class)
                    ->create();

        //this project can invite another user
        $project->invite($anotherUser = factory(\App\User::class)->create());            

        //sign in the new user
        $this->signIn($anotherUser);

        //this user can update the project
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        //the changes are visible
        $this->assertDatabaseHas('tasks', $task);
    }


}
