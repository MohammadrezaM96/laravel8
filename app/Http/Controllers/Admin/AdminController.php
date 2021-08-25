<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Admin;
//use App\Permission;
//use App\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    protected $admin;

//    public function __construct()
//    {
//
//        $this->middleware(function ($request, $next) {
//            $this->admin = auth('admin')->user();
//            if (!$this->admin->can('canAdmin') and $this->admin->id != 1) {
//                abort(404);
//            }
//            return $next($request);
//        });
//
//    }


    public function index()
    {
        $admins = Admin::query()->paginate(10);
        return view('admin.admins.adminsIndex')->with([
            'admins' => $admins
        ]);
    }

    public function createAdmin()
    {
        $admins = Admin::with('roles')->paginate(10);
        $roles = Role::all();
        return view('admin.admins.adminsCreate')->with([
            'admins' => $admins,
            'roles' => $roles
        ]);
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required | min:8 | confirmed',
        ]);
        $admin = new Admin();
        try {
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->save();
            $admin->refreshRoles($request->roles);
        } catch (\Exception $exception) {
            return redirect()->back()->with('warning', $exception->getCode());
        }
        $msg = __('messages.adminSuccess');
        return redirect(route('admin.create'))->with('success', $msg);
    }

    public function editAdmin(Admin $admin)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $admin->load('roles', 'permissions');
        return view('admin.admins.adminsEdit')->with([
            'admin' => $admin,
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }

    public function updateAdmin(Request $request, Admin $admin)
    {
        if (!empty($request->password)) {
            $request->validate([
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|min:5',
            ]);
            $admin->password = Hash::make($request->password);
        } else {
            $request->validate([
                'name' => 'required',
                'username' => 'required',
            ]);
        }
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->refreshRoles($request->roles);
        $admin->save();
        return back()->with('success', __('messages.editSuccess'));
    }

    public function editPerson(Admin $admin)
    {
        return view('admin.admins.adminsPersonEdit' , compact('admin'));
    }


    public function updatePerson(Request $request , Admin $admin)
    {
        try{
            if (!empty($request->password)){
                $request->validate([
                    'name' => 'required',
                    'password' => 'required|min:8',
                ]);
                $admin->password=Hash::make($request->password);
            }else{
                $request->validate([
                    'name' => 'required',
                ]);
            }
            $admin->name=$request->name;
            $admin->save();
        }catch (Exception $exception)
        {
            return redirect()->back()->with('warning', $exception->getCode());
        }
        return back()->with('success' , __('messages.editSuccess'));
    }


    ///////////role functionsssssssssssssss

    //Create Role
    public function createRole()
    {
        $roles = Role::with('permissions')->orderBy('id')->get();
        $permissions = Permission::all();
        return view('admin.admins.rolesCreate')->with([
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function storeRole(Request $request)
    {
        $validationData = $request->validate([

            'name' => 'required',
        ]);
        $role = new Role();
        try {
            $role->name = $request->name;
            $role->save();
            $role->refreshPermissions($request->permissions);
        } catch (\Exception $exception) {
            return redirect()->back()->with('warning', $exception->getCode());
        }
        $msg = __('messages.roleCreateSuccess');
        return redirect(route('role.create'))->with('success', $msg);
    }


    public function editRole(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.admins.rolesEdit')->with([
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function updateRole(Request $request,Role $role)
    {
        $validationData = $request->validate([

            'name' => 'required',
        ]);
        $role->update($request->only('name'));
        $role->refreshPermissions($request->permissions);

        return back()->with('success' , __('messages.editSuccess'));
    }

    public function deleteRole(Request $request)
    {
        dd($request);
        $role =Role::findOrfail($request->id);
        $role->delete();

        return 'deleted';
    }
}
