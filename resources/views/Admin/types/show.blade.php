@extends('admin.layouts.base')

@section('contents')
    <h1>{{ $type->name }}</h1>
    <p>{{ $type->description }}</p>

    <h2>projects in this category</h2>
    <ul>
        @foreach ($type->projects as $project)
           <li><a href="{{ route('admin.project.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
        @endforeach
        
    </ul>
    
@endsection