<x-admin-dash-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
        
        <a href="{{ route('users.create') }}" class="px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Add User
        </a>
    </div>
</x-slot>
@if(session('success'))
    <div class="mb-4">
        <div class="font-medium text-green-600">
            {{ session('success') }}
        </div>
    </div>
@endif
    <div>
    @livewire('users-table')
 
</x-admin-dash-layout>