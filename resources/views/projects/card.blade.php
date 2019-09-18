
    <div class="mb-3">
	    <div class="card flex flex-col" style="height:200px;">
	        <div class="-ml-5">
	        	<div class="tts"></div>
		        <h3 class="py-3 mb-4 ml-4 font-normal text-xl">
		        	{{ $project->title }}
		        </h3>
			</div>
	        <div class="text-grey-dark mb-4 flex-1">
	        	{{ str_limit($project->description, $limit = 40, $end = '...') }}
	        </div>
			
			@can('manage', $project)
		        <footer>
		        	<div class="flex justify-between items-center">
			        	<form method="POST" action="{{ $project->path() }}" class="text-right mt-4">
			        		@csrf
			        		@method('DELETE')

			        		<button type="submit" title="Delete Project" class="text-xs"><svg class="fill-current text-teal inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></button>
			        	</form>
		        		<a href="{{ $project->path() . '/edit'}}" class="mt-4 text-xs no-underline pin-b" title="Edit Project"><svg class="fill-current text-teal inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a>
		        	</div>
		        </footer>
	        @endcan
	      
	    </div>
    </div>
