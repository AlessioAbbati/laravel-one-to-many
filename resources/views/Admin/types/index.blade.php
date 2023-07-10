@extends('admin.layouts.base')

@section('contents')

@if (session('delete_success'))
@php
    $project = session('delete_success')
@endphp
<div class="alert alert-danger">
    "{{ $project->title }}" has been moved to the trash!!
    <form action="{{ route("admin.project.cancel", ['project' => $project] )}}" method="post">
        @csrf
        <button class="btn btn-warning">Cancel</button>
    </form>
</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.type.show', ['type' => $type]) }}">View</a>
                    <a class="btn btn-warning" href="{{ route('admin.type.edit', ['type' => $type]) }}">Edit</a>
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $type->id }}">
                        Delete
                    </button>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form
                    action=""
                    data-template= "{{ route('admin.type.destroy', ['type' => '*****']) }}"
                    method="post"
                    class="d-inline-block"
                    id="btn-confirm-delete"
                >
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection