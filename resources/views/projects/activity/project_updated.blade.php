<b>
@if (count($activity->changes['after']) ==  1) 

Project {{ key($activity->changes['after']) }} updated by {{ $activity->user->name }}
 
@else

Project {{ $project->title }} updated by {{ $activity->user->name }}


@endif
</b>