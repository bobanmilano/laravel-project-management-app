<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectInvitationRequest;


class ProjectInvitationsController extends Controller
{
    

    public function store(Project $project, ProjectInvitationRequest $request) 
    {  

    	$this->authorize('update', $project);

    	$result = request()->validate([
    		'email'	=> ['required', 'exists:users,email']
    	], [
			'email.exists' => 'The user you are inviting must have a valid account!'
    	]);

		$user = User::whereEmail(request('email'))->first();

		$project->invite($user); 

		return redirect($project->path());   	
    }
    

}
