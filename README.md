# Spatie Permissions and Roles - Laravel 10 dashboard 
Ok so things to know befor getting started - 

This is a laravel10 / breeze / spatie permissions starter.

I am a novice with Livewire as you will see but there are a few humble components.

As this stands you need to understand that the permissions are created via the db seeder

in the dashboard you can create new users, create new  roles and assign the roles to users.

The permissions at the moment are : 

```php
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-articles']);
        Permission::create(['name' => 'edit-articles']);
        Permission::create(['name' => 'delete-articles']);

        Permission::create(['name' => 'create-product']);
        Permission::create(['name' => 'list-product']);
        Permission::create(['name' => 'edit-product']);
        Permission::create(['name' => 'delete-product']);
       
        $adminRole = Role::create(['name' => 'Admin']);
        $editorRole = Role::create(['name' => 'Editor']);
        $productmanagerRole = Role::create(['name' => 'ProductManager']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-articles',
            'edit-articles',
            'delete-articles',
            'create-product',
            'list-product',
            'edit-product',
            'delete-product',

        ]);

        $editorRole->givePermissionTo([
            'create-articles',
            'edit-articles',
            'delete-articles',
        ]);

        $productmanagerRole->givePermissionTo([
            'create-product',
            'list-product',
            'edit-product',
            'delete-product',
        ]);
          // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Ed Editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($editorRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Andrew Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole($adminRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Peter Product',
            'email' => 'product@example.com',
            'password' => Hash::make('password')
        ]);
        
        $user->assignRole($productmanagerRole);
    }```


Whilst this is exciting the only restrictions at the moment are on the crud for users
as can be seen in the usercontroller methods eg


```php
 public function create()
    {
        if (!auth()->user()->can('create-users')) {
            abort(403, 'Unauthorized');
        }
        $allRoles = Role::pluck('name','name')->all();
        return view('users.create',compact('allRoles'));
    }```
    
    the reason is it is a starter dash - so if we want a blog we then use the ->can('permission') in the relevant controller
    
    Coupled with this should be the actual route protection using middleware for example : 
    
    Suppose you have a middleware called CheckPermission that checks if a user has a specific permission to access a route. You want to apply this middleware to a specific route.

    Define the middleware in app/Http/Middleware/CheckPermission.php:
    
    ```php
    <?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    public function handle($request, Closure $next, $permissionName)
    {
        // Check if the authenticated user has the specified permission
        if (!auth()->user()->hasPermissionTo($permissionName)) {
            abort(403, 'Unauthorized'); // You can customize the error message
        }

        return $next($request);
    }
}

```
Register the middleware in app/Http/Kernel.php by adding it to the $routeMiddleware array:
  
 ```php
 protected $routeMiddleware = [
    // ... other middleware entries
    'checkPermission' => \App\Http\Middleware\CheckPermission::class,
];

```

Now, you can use the checkPermission middleware in your routes. For example, in routes/web.php:

```php

Route::get('/dashboard', function () {
    return 'Dashboard Page';
})->middleware('checkPermission:create-users'); // Apply the middleware with the specified permission

Route::get('/profile', function () {
    return 'Profile Page';
})->middleware('checkPermission:edit-profile'); // Apply the middleware with a different permission
```

In this example, we've applied the checkPermission middleware to specific routes (/dashboard and /profile) and provided the required permission name as a parameter to the middleware. This allows you to check if the authenticated user has the necessary permission to access each route. If the user doesn't have the permission, they will receive a 403 (Unauthorized) error.

   
## Trouble seeding DB

I was writing tests and munted the DB, a migrate fresh and db --seed kept failing.
   
    
```php
/var/www/basesite$ php artisan db:seed

   INFO  Seeding database.  

  Database\Seeders\RoleAndPermissionSeeder ........................... RUNNING  

   Spatie\Permission\Exceptions\PermissionAlreadyExists 

  A `create-users` permission already exists for guard `web`.
```

so run 

`php artisan cache:forget spatie.permission.cache `

`php artisan cache:clear`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
