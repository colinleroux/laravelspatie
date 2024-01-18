<x-admin-dash-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ auth()->user()->name }}'s Dashboard
            </h2>

            <nav class="flex">
            @if(auth()->user()->hasRole('Admin'))
                <!-- Link to Users Management for Admin -->
                <a href="{{ route('users.index') }}" class="ml-4 text-sm text-gray-700 underline">
                    Manage Users
                </a>
                <!-- Link to Roles Management for Admin -->
                <a href="{{ route('roles.index') }}" class="ml-4 text-sm text-gray-700 underline">
                    Manage Roles
                </a>
                <!-- Link to Products Management for Admin -->
                <a href="{{ route('products.index') }}" class="ml-4 text-sm text-gray-700 underline">
                    Manage Products
                </a>
            @endif

            @if(auth()->user()->hasRole('Editor'))
                <!-- Possible Links for Editor Role -->
                <!-- Add relevant links for the Editor role here -->
            @endif

            <!-- Add other roles and their specific links here -->
            </nav>
        </div>
    </x-slot>

<!-- Rest of your dashboard layout -->





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- User Preferences Block -->
                <a href="/profile" class="block w-full h-64 bg-white bg-opacity-50 backdrop-blur-md p-6 rounded-xl shadow hover:bg-opacity-60 hover:backdrop-blur-lg flex flex-col items-center justify-center">
                    <h3 class="text-4xl font-semibold mb-2">{{ __("Account Preferences") }}</h3>
                    <p class="text-xl">Manage your account preferences.</p>
                </a>

                <!-- Recipes Block -->
                <a href="#" class="block w-full h-64 bg-white bg-opacity-50 backdrop-blur-md p-6 rounded-xl shadow hover:bg-opacity-60 hover:backdrop-blur-lg flex flex-col items-center justify-center">
                    <h3 class="text-4xl font-semibold mb-2">{{ __("Some Management") }}</h3>
                    <p class="text-xl">Manage something here.</p>
                </a>
            </div>
        </div>
    </div>


</x-admin-dash-layout>

