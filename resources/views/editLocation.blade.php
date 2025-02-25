@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Location</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('updateLocation', $location->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Location Name:</label>
            <input type="text" class="form-control" id="name" name="location" value="{{ old('location', $location->location) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('locationList') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection