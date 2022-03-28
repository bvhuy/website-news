<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends AppController
{
    protected $paginate = 20;
    public function authCheck()
    {
        if (!auth()->check()) {
            abort(404);
        } else if (auth()->user()->isDisable()) {
            abort(403, 'This action is unauthorized.');
        }
    }

    public function index()
    {
        $this->authCheck();
        $filter = Role::getRequestFilter();
        $roles = Role::applyFilter($filter)
            ->select('roles.*')
            ->addSelect(\DB::raw('count(users.id) as total_user'))
            ->leftjoin('users', 'users.role_id', '=', 'roles.id')
            ->groupBy('roles.id')
            ->paginate($this->paginate);

        $this->data['roles'] = $roles;
        $this->data['filter'] = $filter;
        return view('admin.role.list', $this->data);
    }

    public function create()
    {
        $this->authCheck();
        $role = new Role();
        $this->data['role'] = $role;
        return view('admin.role.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate($request, [
            'role.name'    =>    'required',
            'role.type'    =>    'required|in:0,option',
            'role.permission' => 'required_if:role.type,option',
        ]);

        \AccessControl::forgetCache();

        $role = new Role();
        $role->fill($request->role)->save();

        if ($role->isOption()) {
            $permissions = [];
            if ($request->has('role.permission')) {
                foreach ($request->input('role.permission') as $perm) {
                    $permissions[] = new Permission(['permission' => $perm]);
                }
            }
            $role->permissions()->saveMany($permissions);
        }

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm vai trò mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.role.edit', ['role' => $role->id]) :
                    route('admin.role.create'),
            ], 200);
        }

        if ($request->exists('save_only')) {
            return redirect()->route('admin.role.edit', ['id' => $role->id]);
        }

        return redirect()->route('admin.role.create');
    }

    public function edit(Role $role)
    {
        $this->authCheck();



        if ($role->isFull()) {
            abort(403);
        }

        foreach ($role->permissions as $per) {
            if ($per->permission == 'admin.role.manage') {
                abort(403);
            }
        }

        $this->data['role'] = $role;
        $this->data['role_id'] = $role->id;
        return view('admin.role.save', $this->data);
    }

    public function update(Request $request, Role $role)
    {
        $this->authCheck();

        if ($role->isFull()) {
            abort(403);
        }

        foreach ($role->permissions as $per) {
            if ($per->permission == 'admin.role.manage') {
                abort(403);
            }
        }

        $this->validate($request, [
            'role.name'    =>    'required',
            'role.type'    =>    'required|in:0,option',
            'role.permission' => 'required_if:role.type,option',
        ]);

        \AccessControl::forgetCache();

        $role->fill($request->role)->save();

        $role->permissions()->delete();

        if ($role->isOption()) {
            $permissions = [];
            if ($request->has('role.permission')) {
                foreach ($request->input('role.permission') as $perm) {
                    $permissions[] = new Permission(['permission' => $perm]);
                }
            }
            $role->permissions()->saveMany($permissions);
        }

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Đã cập nhật vai trò',
            ];
            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.role.index');
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.role.index');
        }

        return redirect()->back();
    }

    public function destroy(Request $request, Role $role)
    {


        if ($role->isFull()) {
            abort(403);
        }

        foreach ($role->permissions as $per) {
            if ($per->permission == 'admin.role.manage') {
                abort(403);
            }
        }

        if ($role->users->count()) {
            if ($request->ajax()) {
                $response = [
                    'title'        =>    trans('cms.error'),
                    'message'    =>    trans('role.role-has-user'),
                    'redirect'    =>    route('admin.role.index')
                ];
            }

            return response()->json($response, 402);
        }

        // $role->users->update([
        //     'role_id' => 0
        // ]);

        $role->delete();

        if ($request->ajax()) {

            $response = [
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('role.destroy-role-success'),
                'redirect'    =>    route('admin.role.index')
            ];


            return response()->json($response, 200);
        }

        return redirect()->back();
    }
}
