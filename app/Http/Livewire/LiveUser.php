<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permissions;
use Hash;

class LiveUser extends Component
{   
    public $selectData = true;
    public $createData = false;
    public $updateData = false;

    public $ids;
    public $user;

    public $name;
    public $email;
    public $password;
    public $role;

    public $edit_name;
    public $edit_email;
    public $edit_role;

    
    public function showForm ()
    {
        $this->selectData = false;
        $this->createData = true;
    }


    public function resetFields ()
    {
        $this->fullname   ="";
        $this->email      ="";
        $this->password   ="";
        $this->role       ="";
    }


    public function render ()
    {   
        $roles = Role::all();
        $regionalRoles = Role::where('id', 2)->get();
        $users = User::all();
        return view('livewire.live-user', ['users' => $users, 'roles' => $roles, 'regionalRoles' => $regionalRoles])->layout('layouts.admin.master');
    }


    public function create ()
    {
        $validatedData = $this->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'role'      => 'required|numeric|exists:roles,id',
        ]);

        $user = new User();
            $user->name     = $validatedData['name'];
            $user->email    = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

        if ($validatedData['role'] == 1)
        { $user->assignRole(['Platform Admin']); } 

        elseif ($validatedData['role'] == 2) 
        { $user->assignRole(['Corporate Admin']); }

        elseif ($validatedData['role'] == 3) 
        { $user->assignRole(['Regional Admin']); }

        elseif ($validatedData['role'] == 4) 
        { $user->assignRole(['Facility Admin']); }
        
        elseif ($validatedData['role'] == 5) 
        { $user->assignRole(['Facility Editor']); }

        $this->selectData = true;
        $this->createData = false;
    }


    public function edit ($id)
    {
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

        $user = User::findOrFail($id);
            $this->edit_name  = $user->name;
            $this->edit_email = $user->email;
            $this->ids        = $user->id;
    }

    
    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name'      => 'required',
            'edit_email'     => 'required|email|unique:users,email',
            'password'       => 'required',
            'edit_role'      => 'required|numeric|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
            $user->name = $validatedData['edit_name'];
            $user->email = $validatedData['edit_email'];
            $user->password = $validatedData['password'];
            $user->save();

        if ($validatedData['edit_role'] == 1)
        {   
            $user->removeRole($user->roles->first());
            $user->assignRole(['Platform Admin']);
        } 

        elseif($validatedData['edit_role'] == 2) 
        {
            $user->removeRole($user->roles->first());
            $user->assignRole(['Corporate Admin']);
        } 
        
        elseif($validatedData['edit_role'] == 3)
        {
            $user->removeRole($user->roles->first());
            $user->assignRole(['Regional Admin']);
        }

        elseif($validatedData['edit_role'] == 4) 
        {
            $user->removeRole($user->roles->first());
            $user->assignRole(['Facility Admin']);
        }

        elseif($validatedData['edit_role'] == 5) 
        {
            $user->removeRole($user->roles->first());
            $user->assignRole(['Facility Editor']);
        }

        $this->selectData = true;
        $this->updateData = false;
    }

    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
