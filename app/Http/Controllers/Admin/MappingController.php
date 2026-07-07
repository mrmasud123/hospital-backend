<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MappingController extends Controller
{
    public function rolePermissionMapping(){

        return view('admin.mapping.with-role-permission',['title' => "Role Permission Mapping"] );
    }

    public function storeMapping(Request $request)
    {
        // return $request->input();
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'roles' => 'required|array',
        ]);

        $employee = User::findOrFail($request->employee_id);

        $roleNames = Role::whereIn('id', $request->roles)
            ->pluck('name')
            ->toArray();

        $employee->syncRoles($roleNames);

        return redirect()->back()->with('success', 'Role mapping saved successfully.');
    }

    public function userWithRolesPermissionData()
    {
        return DataTables::of(User::query())

            // ROLE COLUMN (Spatie)
            ->addColumn('role', function ($employee) {

                $roles = $employee->getRoleNames();

                if ($roles->isEmpty()) {
                    return '<span class="text-gray-500">No Role</span>';
                }

                return $roles->map(function ($role) {
                    return '<span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600 mr-1">'
                        . $role .
                        '</span>';
                })->implode(' ');
            })

            ->addColumn('action', function ($employee) {

                return '
                    <a href="'.route('admin.assign.role', $employee->id).'"
                    class="text-blue-600 mr-2">
                    Assign Role
                    </a>
                ';
            })

            ->rawColumns(['role', 'permissions', 'action'])
            ->make(true);
    }

    public function assignEmployeeRole(User $user){
        $roles = Role::select('id', 'name')->get();

        $user = User::select('id', 'name', 'email')
            ->with('roles:id,name')
            ->findOrFail($user->id);
        $title= "Assign Employee Role";
        return view('admin.mapping.role-permission-mapping', compact('title','roles', 'user'));
    }
}
