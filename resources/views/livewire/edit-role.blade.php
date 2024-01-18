<div>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-3">
            <div class="col-span-12 mb-3">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input wire:model="name" type="text" id="name" name="name"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Name" required>
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 mb-3">
                <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions:</label>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Select
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label class="inline-flex items-center mt-2">
                                        <input wire:model="selectedPermissions" type="checkbox" name="selectedPermissions[]"
                                            value="{{ $permission->id }}">
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @error('selectedPermissions') <span class="text-red-600">{{ $message }}</span> @enderror
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