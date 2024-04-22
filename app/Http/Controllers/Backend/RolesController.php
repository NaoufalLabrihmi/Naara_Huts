<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;

class RolesController extends Controller
{
    public function Index()
    {
        $roles = Role::get();
        return view('backend.roles.index', compact('roles'));
    }

    public function Create()
    {
        return view('backend.roles.create');
    }


    public function Store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);

        try {
            $role = $this->process(new Role, $request);
            if ($role) {
                $notification = array(
                    'message' => 'Role Created Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('roles.index')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Error',
                    'alert-type' => 'error'
                );
            }
        } catch (\Exception $ex) {
            return $ex;
            $notification = array(
                'message' => 'Something Wrong',
                'alert-type' => 'error'
            );
        }
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }

    public function Edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.edit', compact('role'));
    }

    public function Update($id, Request $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role) {
                $notification = array(
                    'message' => 'Role Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('roles.index')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Error',
                    'alert-type' => 'error'
                );
            }
        } catch (\Exception $ex) {
            return $ex;
            $notification = array(
                'message' => 'Something Wrong',
                'alert-type' => 'error'
            );
        }
    }


    public function UsersIndex()
    {
        $users = User::get();

        return view('backend.users.index', compact('users'));
    }
    public function UsersCreate()
    {
        $roles = Role::get();
        return view('backend.users.add', compact('roles'));
    }

    public function StoreUser(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $filename);
            $save_url = $filename;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'photo' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'User Data Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('users.list')->with($notification);
    }

    public function EditUser($id)
    {
        $user = User::findOrFail($id);
        $role = Role::get();
        return view('backend.users.edit_user', compact('user', 'role'));
    }

    public function UpdateUser(Request $request)
    {

        $user_id = $request->id;
        $user = User::find($user_id);
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $save_url = $filename;
            // Delete the old image file if it exists
            if ($user->photo && file_exists(public_path('upload/user_images/' . $user->photo))) {
                unlink(public_path('upload/user_images/' . $user->photo));
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'photo' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('users.list')->with($notification);
    }


    public function DeleteUser($id)
    {
        $item = User::findOrFail($id);
        $img = 'upload/user_images/' . $item->photo;
        unlink($img);
        $item->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('users.list')->with($notification);
    }

    public function DeleteRole($id)
    {
        $item = Role::findOrFail($id);
        $item->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('roles.index')->with($notification);
    }
}
