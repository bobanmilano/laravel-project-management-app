@extends('layouts.app')


@section('content')

<div class="object-center w-1/4" style="display:table; margin: 100px auto;">

          <form method="POST" action="/projects" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title">
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
              </label>
              <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder="Description">
          
            </div>
                  <div class="mb-6">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                Notes
              </label>
              <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="notes" name="notes" type="text" placeholder="Description">
          
            </div>
            <div class="flex items-center justify-between">
              <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Create
              </button>
              <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/projects">
                Cancel
              </a>
            </div>
          </form>
          <p class="text-center text-gray-500 text-xs">
            &copy;2019 Acme Corp. All rights reserved.
          </p>

</div>
@endsection
