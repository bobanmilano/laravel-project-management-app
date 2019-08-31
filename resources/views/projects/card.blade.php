
    <div class="pb-6">
	    <div class="card" style="height:200px;">
	        <h3 class="py-4 mb-6 font-normal text-xl">
	        	{{ $project->title }}
	        </h3>
	        <div class="text-grey-dark">
	        	{{ str_limit($project->description, 120) }}
	        </div>
	    </div>
    </div>
