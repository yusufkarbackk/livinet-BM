@extends('layouts.admin')

@section('content')
<div class="card">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Building Manager Data</h2>
            <a href="/location">
                <button class="btn btn-success text-white">Add Location</button>
            </a>
        </div>
        <table id="buildingManagerTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Created At</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->location }}</td>
                    <td>{{ $location->created_at }}</td>
                    <td>
                        <a class="" href="/location/{{$location->id}}/edit">
                            <button type="button" class="btn btn-info">Edit</button>
                        </a>
                        <form action="/location/{{$location->id}}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection