@extends('layouts.app')


@section('content')

<div class="object-center w-1/3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" style="display:table; margin: 100px auto;">
<h1 class="text-2xl font-normal mb-10 text-center">Edit project <b>{{ $project->title }}</b></h1>
          <form method="POST" action="{{ $project->path() }}">
            @csrf
            @method('PATCH')
       
            @include('projects._form', ['buttonText' => 'Update Project'])
          
          </form>
      
          <p class="text-center text-gray-500 text-xs mt-12">
            &copy;2019 Freelancer Corp. All rights reserved.
          </p>
      

</div>

@endsection