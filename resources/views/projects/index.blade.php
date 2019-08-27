<!DOCTYPE html>
<html>
    <head>
  

        <title>Laravel</title>


    </head>
    <body>

        <h2>Birdboard</h2>


        <ul>
            @forelse($projects as $project)
                <li >
                    <a href="{{ $project->path() }}">{{ $project->title }}</a>
                </li>
            @empty        
                <li>No projects yet.</li>
            @endforelse
        </ul>
        
    </body>
</html>
