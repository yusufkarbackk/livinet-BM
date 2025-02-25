@extends('layouts.admin')

@section('content')

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
            <h1>Add Location</h1>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('insertLocation') }}">
            @csrf

            <div class="mt-4">
                <x-label for="locatioName" value="{{ __('locationName') }}" class="text-white" />
                <x-input id="locationName" class="block mt-1 w-full text-black" type="text" name="locationName" :value="old('locationName')" required autocomplete="locationName" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
@endsection