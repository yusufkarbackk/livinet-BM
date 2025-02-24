@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit User - {{ $user->email }}</h2>

    <form action="{{ route('update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">User Locations:</label>
            <div class="border p-3" style="max-height: 300px; overflow-y: auto;"> <!-- Scrollable -->
                @foreach($locations as $location)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="locations[]" value="{{ $location->id }}"
                        {{ in_array($location->id, $userLocationIds) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $location->location }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="/dashboard" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection