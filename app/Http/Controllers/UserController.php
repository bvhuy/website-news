<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Role;

class UserController extends AppController
{
    protected $paginate = 5;
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
        $filter = User::getRequestFilter();
        $users = User::select('users.*', 'roles.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->applyFilter($filter)->paginate($this->paginate);

        $this->data['users']    = $users;
        $this->data['filter']   = $filter;

        return view('admin.user.list', $this->data);
    }
    public function create()
    {
        $this->authCheck();
        $user = new User();
        $this->data['user'] = $user;

        return view('admin.user.save', $this->data);
    }
    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate($request, [
            'user.last_name'                => 'required|max:255',
            'user.first_name'                => 'required|max:255',
            'user.name'                    => 'required|unique:users,name',
            'user.email'                    => 'required|email|max:255|unique:users,email',
            'user.password'                => 'required|confirmed',
            'user.password_confirmation'    => 'required',
            'user.role_id'                    => 'required|exists:roles,id|required_if:user.role_id,option,0',
            'user.status'                    => 'required|in:enable,disable'
        ]);

        $user = new User();
        $user->fill($request->input('user'));
        $user->password = bcrypt($user->password);
        $user->api_token = Str::random(60);

        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm người dùng mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.user.edit', ['user' => $user->id]) :
                    route('admin.user.create'),
            ], 200);
        }

        if ($request->exists('save_only')) {
            return redirect()->route('admin.user.edit', ['user' => $user->id]);
        }

        return redirect()->route('admin.user.create');
    }
    public function edit(User $user)
    {
        $this->authCheck();
        // if ($user->isSelf()) {
        //     return redirect(route('admin.profile.show'));
        // }
        if ($user->isSelf()) {
            abort(403);
        } else if ($user->role->isFull()) {
            abort(403);
        }

        $this->data['user'] = $user;
        $this->data['user_id'] = $user->id;
        return view('admin.user.save', $this->data);
    }
    public function update(Request $request, User $user)
    {
        $this->authCheck();

        if ($user->isSelf()) {
            abort(403);
        } else if ($user->role->isFull()) {
            abort(403);
        }

        $this->validate($request, [
            'user.last_name'                => 'required|max:255',
            'user.first_name'                => 'required|max:255',
            'user.email'                    => 'required|email|max:255|unique:users,email,' . $user->id . ',id',
            'user.role_id'                    => 'required|exists:roles,id|required_if:user.role_id,option,0',
            'user.status'                    => 'required|in:enable,disable',
        ]);

        $user->fill($request->input('user'))->save();

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Đã cập nhật người dùng',
            ];

            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.user.index');
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.user.index');
        }

        return redirect()->back();
    }
    public function disable(Request $request, User $user)
    {
        $this->authCheck();
        if ($user->isSelf()) {
            abort(403);
        } else if ($user->role->isFull()) {
            abort(403);
        }

        $user->markAsDisable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('user.disable-user-success'),
                'redirect'    =>    route('admin.user.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function enable(Request $request, User $user)
    {
        $this->authCheck();
        if ($user->isSelf()) {
            abort(403);
        } else if ($user->role->isFull()) {
            abort(403);
        }

        $user->markAsEnable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('user.enable-user-success'),
                'redirect'    =>    route('admin.user.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, User $user)
    {
        $this->authCheck();
        if ($user->isSelf()) {
            abort(403);
        } else if ($user->role->isFull()) {
            abort(403);
        }

        $user->delete();
        if ($request->ajax()) {
            return response()->json([
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('user.destroy-user-success'),
                'redirect'    =>    route('admin.user.index')
            ], 200);
        }

        return redirect()->back();
    }
}
