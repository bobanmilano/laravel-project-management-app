@extends('layouts.app')


@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex items-end justify-between w-full">
        <h2 class="text-grey text-sm font-normal">Projects</h2>

        <button class="button text-white font-bold py-2 px-4 rounded" @click.prevent="$modal.show('new-project')">Create a new project</button>
    </div>
</header>


<main class="flex flex-wrap -mx-3 mt-10">
     @forelse($projects as $project)
     <div class="lg:w-1/4 px-3 pb-6">
        <a href="/projects/{{ $project->id }}" class="no-underline">@include('projects.card')</a>
    </div>
    @empty 
        <div>No projects yet.</div>
    @endforelse  

</main>


<new-project-modal></new-project-modal>
        
@endsection
