@extends('layouts.admin')

@section('content')

<x-guest-layout>
    <section class="bg-success d-flex justify-content-center align-items-center vh-100 gradient-custom">
        <div class="container my-auto">
            <div class="card shadow-lg p-4" style="max-width: 400px; margin: auto;">
                <h4 class="text-center mb-4">Add Location</h4>
                <x-validation-errors class="mb-4" />

                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('insertLocation') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="locationName" class="form-control" required placeholder="Enter Location">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Add Location</button>
                    </div>
                </form>
            </div>
        </div>


    </section>
</x-guest-layout>
@endsection