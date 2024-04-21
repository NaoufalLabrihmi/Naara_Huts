<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\FuncCall;

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
}
