@extends('layouts.admin')

@section('content')

<body>
    <x-guest-layout>
        <section class="bg-success d-flex justify-content-center align-items-center vh-100 gradient-custom">
            <div class="container my-auto">
                <div class="card shadow-lg p-4" style="max-width: 400px; margin: auto;">
                    <h4 class="text-center mb-4">Register BM</h4>
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="/registerBM">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Locations</label>
                            <!-- Dropdown wrapper -->
                            <div x-data="{ open: false, search: '', locations: {{ \App\Models\location::orderBy('location', 'asc')->get() }} }" class="relative">
                                <button @click="open = !open" type="button" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Select Locations
                                </button>

                                <!-- Dropdown content -->
                                <div style="max-height: 250px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;"
                                    x-show="open"
                                    @click.away="open = false"
                                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">

                                    <!-- Search Input -->
                                    <input type="text"
                                        x-model="search"
                                        placeholder="Search locations..."
                                        class="w-full p-2 border-b border-gray-300 focus:outline-none">

                                    <!-- List of Locations -->
                                    <template x-for="location in locations.filter(loc => loc.location.toLowerCase().includes(search.toLowerCase()))">
                                        <div class="flex items-center px-4 py-2">
                                            <input type="checkbox" :name="'locations[]'" :value="location.id" :id="'location-' + location.id" class="mr-2">
                                            <label :for="'location-' + location.id" x-text="location.location"></label>
                                        </div>
                                    </template>

                                    <!-- No Results Message -->
                                    <div x-show="locations.filter(loc => loc.location.toLowerCase().includes(search.toLowerCase())).length === 0" class="p-2 text-gray-500 text-center">
                                        No results found
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>


        </section>
    </x-guest-layout>

</body>
@endsection