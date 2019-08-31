@extends('layouts.app')


@section('content')

        <form method="POST" action="/projects" >
            
            @csrf

            <h1 class="heading is-1">Create new Project</h1>
            
            <div class="field">
                <label class="label" for="title">Title</label>
                <div class="control">
                    <input type="text" class="input" name="title" placeholder="">
                </div>
            </div>

             <div class="field">
                <label class="label" for="description">Description</label>
                <div class="control">
                    <input type="text" class="input" name="description" placeholder="">
                </div>
            </div>

            <div class="field">           
                <div class="control">
                    <button type="submit" class="button is-link">Create</button>
                    <a href="/projects">Cancel</a>
                </div>
            </div>

        </form>

@endsection
