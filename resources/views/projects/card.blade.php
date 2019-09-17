
    <div class="mb-3">
	    <div class="card flex flex-col" style="height:200px;">
	        <div class="-ml-5">
	        	<div class="tts"></div>
		        <h3 class="py-3 mb-4 ml-4 font-normal text-xl">
		        	{{ $project->title }}
		        </h3>
			</div>
	        <div class="text-grey-dark mb-4 flex-1">
	        	{{ str_limit($project->description), 120 }}
	        </div>
			
			@can('manage', $project)
		        <footer>
		        	<form method="POST" action="{{ $project->path() }}" class="text-right mt-4">
		        		@csrf
		        		@method('DELETE')

		        		<button type="submit" class="text-xs">Delete</button>
		        	</form>
		        </footer>
	        @endcan
	      
	    </div>
    </div>
