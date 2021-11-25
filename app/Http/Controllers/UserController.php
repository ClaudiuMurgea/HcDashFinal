<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{   
    private $roles;
    private $is_admin;

    public function __construct ()
    {   
        $this->middleware('auth');
        $this->roles = Role::all();      
        // $this->is_admin = Auth::user()->hasRole('Platform Admin') ? true : false;
    }


    public function create ()
    {  
        $roles = Role::all(); 
        return view('user.create', compact('roles'));
    }

    public function store (Request $request)
    {   
        
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'role'      => 'required|numeric|exists:roles,id',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make( $request->password );
        $user->save();

        $user->syncRoles($request->role);

        if ($request->role == 1){
            $user->assignRole(['Platform Admin']);
            $user->syncPermissions(['Platform Admin', 'Corporate Admin', 'Regional Admin', 'Facility Admin', 'Facility Editor']);
            // $user->givePermissionTo('')
        } elseif($request->role == 2) {
            $user->assignRole(['Corporate Admin']);
            $user->syncPermissions(['Corporate Admin', 'Regional Admin', 'Facility Admin', 'Facility Editor']);
        } elseif($request->role == 3) {
            $user->assignRole(['Regional Admin']);
            $user->syncPermissions(['Regional Admin', 'Facility Admin', 'Facility Editor']);
        }elseif($request->role == 4) {
            $user->assignRole(['Facility Admin']);
            $user->syncPermissions(['Facility Admin', 'Facility Editor']);
        }elseif($request->role == 5) {
            $user->assignRole(['Facility Editor']);
            $user->syncPermissions(['Facility Editor']);
        }

        return redirect()->route('user.create');
    }

}
