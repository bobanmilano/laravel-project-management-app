<!DOCTYPE html>
<html>
    <head>
  

        <title>Laravel</title>


    </head>
    <body>

        <h2>Birdboard</h2>


        <ul>
            @foreach($projects as $project)
                <li >{{ $project->title }} </li>
            @endforeach
        </ul>
        
    </body>
</html>
