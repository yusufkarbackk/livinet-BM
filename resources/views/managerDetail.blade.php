@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-title">Locations for {{ $user->email }}</div>
            <div class="card-content">
                <ul class="location-list">
                    @forelse ($user->locations as $location)
                    <li>{{ $location->location }}</li>
                    @empty
                    <li>No locations assigned to this user.</li>
                    @endforelse
                </ul>
            </div>
            <a href="/manager/{{$user->id}}/edit">
                <button type="button" class="btn btn-warning">Edit</button>
            </a>
        </div>
    </div> 
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
@endsection