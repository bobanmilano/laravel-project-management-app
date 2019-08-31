@extends('layouts.app')



@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex items-end justify-between w-full">
        <h2 class="text-grey text-sm font-normal">Projects</h2>

        <a href="/projects/create"><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">Create a new project</button></a>
    </div>
</header>



<div class="flex flex-wrap -mx-3 mt-10">
     @forelse($projects as $project)
     <div class="lg:w-1/4 px-3 pb-6">
        <a href="/projects/{{ $project->id }}" class="no-underline">@include('projects.card')</a>
    </div>
    @empty 
        <div>No projects yet.</div>
    @endforelse  

</div>



        
@endsection
