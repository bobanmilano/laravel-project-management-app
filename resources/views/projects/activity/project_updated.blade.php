
@if (count($activity->changes['after']) ==  1) 

Project <b>{{ key($activity->changes['after']) }}</b> updated.

@else

Project <b>{{ $project->title }}</b> updated.


@endif