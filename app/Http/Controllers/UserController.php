<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
 {
    $users = User::all(); // or use pagination if there are many users
    return view('users.index', compact('users'));
}
    

    public function create()
    {
        if (!auth()->user()->can('create-users')) {
            abort(403, 'Unauthorized');
        }
        $allRoles = Role::pluck('name','name')->all();
        return view('users.create',compact('allRoles'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'sometimes|nullable|confirmed',
        ]);
    
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            // If the password field is empty, remove it from the input
            unset($input['password']);
            unset($input['password_confirmation']);
        }
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    public function edit($id)
    {
        if (!auth()->user()->can('edit-users')) {
            abort(403, 'Unauthorized');
        }
        $user = User::find($id);
        $allRoles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','allRoles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|confirmed',
            
        ]);
    
        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
                unset($input['password']);
                unset($input['password_confirmation']);
        }
    
        $user = User::find($id);
        $user->update($input);

       // Update roles based on the selected checkboxes
    if ($request->has('roles')) {
        $user->syncRoles($request->input('roles'));
    } else {
        $user->syncRoles([]); // Remove all roles if none are selected
    }

    return redirect()->route('users.index')
                    ->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete-users')) {
            abort(403, 'Unauthorized');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}