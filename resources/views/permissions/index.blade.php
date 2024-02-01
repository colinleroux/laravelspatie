<x-admin-dash-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permission Management
            </h2>
            <a href="{{ route('permissions.create') }}" class="px-3 py-2 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800">Add Permission</a>
        </div>
    </x-slot>
    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif
    @livewire('permissions-table')
</x-admin-dash-layout>
