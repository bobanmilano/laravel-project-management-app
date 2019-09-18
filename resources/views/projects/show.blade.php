@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex items-end justify-between w-full">
        <p class="text-grey text-sm font-normal">
        	<a href="/projects" class="no-underline text-grey text-sm font-normal">My Projects</a> / {{ $project->title }} </p>
      
      <div class="flex items-center"> 

            @foreach($project->members as $user)
              <img src="/images/{{ $user->name }}.jpg" alt="{{ $user->name }}" class="w-10 h-10 rounded-full mr-2"/>
            @endforeach
              <img src="/images/{{ $project->owner->name }}.jpg" alt="{{ $project->owner->name  }}" class="w-10 h-10 rounded-full mr-2"/>

              <modal name="invite-user"  classes="py-10 card rounded-lg" height="auto">

                    <div class="flex flex-col mt-6">
                                
                          <div class="-ml-5">
                              <div class="tts"></div>
                              <h3 class="py-3 mb-4 ml-4 font-normal text-xl">
                                Invite a User
                              </h3>
                          </div>
                                    
                          <form method="POST" action="{{ $project->path() . '/invitations'}}" class="text-right mt-4">
                            @csrf
                              <div class="mb-3">
                                  <input type='email' name="email" class="py-2 px-3 border w-full border-grey rounded" placeholder="Email address">
                              </div>

                              <div class="flex justify-between">
                                <button type="submit" class="text-xs button">Invite</button>
                                <button class="text-xs button-default">Cancel</button>
                              </div>
                          </form>

                          @include('errors', ['bag' => 'invitations'])
                                       
                    </div>

              </modal>
            <button class="button text-white font-bold py-2 px-4 ml-6 rounded" @click.prevent="$modal.show('invite-user')">Invite a User</button>
      
      </div>

    </div>
</header>

<main>
      <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                	<div class="mb-8">
                            <h2 class="text-grey text-lg font-normal mb-2">Tasks</h2>
                            
                            @foreach($project->tasks as $task) 
                              <div class="card  mb-3"> 
                                <form action="{{ $task->path() }}" method="POST">
                                  @method('PATCH')
                                  @csrf
                                <div class="flex items-end justify-between w-full ">
                                <input value="{{ $task->body }}" name="body" class="w-full {{$task->completed ?  'text-grey': ''}}"> 
                                <input type="checkbox" name="completed" onChange="this.form.submit()"
                                {{ $task->completed ? "checked" : '' }}>
                              </div>
                                </form>
                              </div>
                            @endforeach

                              <div class="card mb-3">
                                <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                  @csrf
                                  <input class="w-full" placeholder="Add a new task to the project" name="body"/>
                                  <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" type="submit">Submit</button>
                                </form>
                              </div>

        			   </div>
            			<div class="mb-6">
                      <h2 class="text-grey text-lg font-normal mb-2">General Notes</h2>
                        <form method="POST" action="{{ $project->path() }}">
                          @method('PATCH')
                          @csrf
                          <textarea 
                              class="card w-full mb-4" 
                              style="min-height:200px;" 
                              name="notes"
                              placeholder="General notes here.">{{ $project->notes }}
                          </textarea>
                            <button type="submit" class="button">Submit</button>
                        </form>
                @include('errors')
                       

            			</div>
            </div>

        		<div class="lg:w-1/4 px-3">
                	@include('projects.card')
                  @include('projects.activity.card')

                  @can('manage', $project)
                      @include('projects.invite')
                  @endcan
        		</div>
      </div>
</main>

        <div class="mt-10"><a href="/projects">Go Back</a></div>
      
@endsection        

