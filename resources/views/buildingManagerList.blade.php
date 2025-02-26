@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Building Manager Data</h1>
            <a href="/register">
                <button class="btn btn-success text-white">Add Building Manager</button>
            </a>
        </div>
        <table id="buildingManagerTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managers as $manager)
                <tr>
                    <td>{{ $manager->id }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->created_at }}</td>
                    <td>
                        <a class="" href="/managerDetail/{{$manager->id}}">
                            <button type="button" class="btn btn-info">Detail</button>
                        </a>
                        <form action="/users/{{$manager->id}}}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
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