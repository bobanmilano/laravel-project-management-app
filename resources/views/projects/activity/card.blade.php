
          <div class="card mt-6">
            <h3 class="text-grey-dark text-lg font-normal mb-2">Activity feed</h3>
            <ul class="text-sm list-reset">
               @foreach($project->activity as $activity)
                <li class="{{ $loop->last ? '' : 'mb-2'}}">
                  @include("projects.activity.$activity->description")
                  <span class="text-grey">
                    {{ $activity->created_at->diffForHumans(null, true) }}
                  </span>
                </li>
               @endforeach 
            </ul>

          </div>