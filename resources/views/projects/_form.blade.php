            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" value="{{ $project->title }}" required>
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
              </label>
              <textarea class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" value="{{ $project->description }}" required>{{ $project->description }}</textarea>
          
            </div>
                  
            <div class="flex items-center justify-between">
              <button class="button text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                {{ $buttonText }}
              </button>
            
              <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ $project->path() }}">
                Cancel
              </a>
            
            </div>
            @if($errors->any())
              <div class="mt-6">
            
                  @foreach($errors->all() as $error)
                    <li class="text-sm text-red">{{ $error }}</li>
                  @endforeach
              

              </div>  
            @endif