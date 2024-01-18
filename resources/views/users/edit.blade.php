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
    
    <div class="ml-4 mr-4">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PATCH') <!-- Use Blade directive to set the HTTP method -->
<!-- Validation Errors -->
@if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="text-center my-2">
    @if (session('success'))
        <div class="font-medium text-green-600">
            {{ session('success') }}
        </div>
    @endif
</div>



    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 mb-3">
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}"
                   class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                   placeholder="Name" required>
        </div>
        <div class="col-span-12 mb-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}"
                   class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                   placeholder="Email" required>
        </div>
        <div class="col-span-12 mb-3">
            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
            <input type="password" id="password" name="password"
                   class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                   placeholder="Password">
        </div>
        <div class="col-span-12 mb-3">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password"
                   class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                   placeholder="Confirm Password">
        </div>
        <div class="col-span-12 mb-3">
    <label for="roles" class="block text-sm font-medium text-gray-700">Roles:</label>
    @foreach ($allRoles as $roleName => $roleLabel)
        <label class="inline-flex items-center mt-2">
            <input type="checkbox" name="roles[]" value="{{ $roleName }}" {{ in_array($roleName, $userRole) ? 'checked' : '' }}>
            <span class="ml-2">{{ $roleLabel }}</span>
        </label>
    @endforeach
</div>

        <div class="col-span-12 mb-3 text-center">
            <button type="submit"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                Submit
            </button>
        </div>
    </div>
</form>

</div>
</x-admin-dash-layout>