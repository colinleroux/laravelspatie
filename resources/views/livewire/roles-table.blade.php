
<div class="py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-2 ">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pt-4 px-2 pb-4 bg-white ">
            
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="flex">
                            <th scope="col" class="flex items-center cursor-pointer w-1/6 px-6 py-3 ">
                                Role
                                
                            </th>
                        
                            <th scope="col" class="flex items-center cursor-pointer w-1/6 px-6 py-3 ">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($roles as $role)
                        <tr class="flex bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <td class="w-1/6 px-6 py-4 flex items-center">
                            {{ $role->name }}
                            </td>

                                                  
                                              
                            <td class="w-1/6 px-6 py-4 flex items-center">
                           
                         
                          
                           
                                <div class="inline-flex rounded-md shadow-sm">
                            
                                <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:text-green-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Delete
                                    </button>
                                </form>
                                </div>

                            </td>
                        
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>
</div>
