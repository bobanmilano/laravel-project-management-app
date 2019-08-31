@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex items-end justify-between w-full">
        <p class="text-grey text-sm font-normal">
        	<a href="/projects" class="no-underline text-grey text-sm font-normal">My Projects</a> / {{ $project->title }} </p>

        <a href="/projects/create"><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">Create a new project</button></a>
    </div>
</header>

<main>
    <div class="lg:flex -mx-3">

        <div class="lg:w-3/4 px-3 mb-6">
        	<div class="mb-8">

                    <h2 class="text-grey text-lg font-normal mb-2">Tasks</h2>
                    
                    @foreach($project->tasks as $task) 
                      <div class="card  mb-3"> {{ $task->body }} </div>
                    @endforeach
			</div>
			<div class="mb-6">
                   <h2 class="text-grey text-lg font-normal mb-2">General Notes</h2>
                   <textarea class="card w-full" style="min-height:200px;">Lorem ipsum ..
                   </textarea>
			</div>
        </div>
		<div class="lg:w-1/4 px-3">
        	@include('projects.card')
		</div>
    </div>
</main>



        <div class="mt-10"><a href="/projects">Go Back</a></div>
      
@endsection        

