<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Validator;

class MenuController extends AppController
{
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
        $this->data['menus'] = Menu::defaultOrder()->get()->toTree();
        return view('admin.menu.list', $this->data);
    }

    public function create()
    {
        $this->authCheck();
        $this->data['menu'] = new Menu();
        return view('admin.menu.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate($request, [
            'menu.name'        => 'required|max:255',
            'menu.slug'            => 'max:255'
        ]);

        $menu = new Menu();
        $menu->fill($request->input('menu'))->save();


        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm menu mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.menu.edit', ['menu' => $menu->id]) :
                    route('admin.menu.create'),
            ]);
        }

        if ($request->exists('save_only')) {
            return redirect(route('admin.menu.edit', ['menu' => $menu->id]));
        }

        return redirect(route('admin.menu.create'));
    }

    public function edit(Menu $menu)
    {
        $this->authCheck();
        $this->data['menu'] = $menu;
        $this->data['menu_id'] = $menu->id;
        return view('admin.menu.save', $this->data);
    }

    public function update(Request $request, Menu $menu)
    {
        $this->authCheck();
        $this->validate($request, [
            'menu.name'        => 'required|max:255'
        ]);

        $menu->fill($request->input('menu'))->save();

        if ($request->ajax()) {
            $response = [
                'title'      =>    'Thành công',
                'message'    =>    'Đã cập nhật menu',
            ];
            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.menu.index');
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.menu.index');
        }

        return redirect()->back();
    }

    public function disable(Request $request, Menu $menu)
    {
        $this->authCheck();
        $menu->markAsDisable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('menu.disable-menu-success'),
                'redirect' => route('admin.menu.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function enable(Request $request, Menu $menu)
    {
        $this->authCheck();
        $menu->markAsEnable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    trans('cms.success'),
                'message'    =>    trans('menu.enable-menu-success'),
                'redirect' => route('admin.menu.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, Menu $menu)
    {
        $this->authCheck();
        $menu->delete();

        if ($request->ajax()) {
            return response()->json([
                'title' => trans('cms.success'),
                'message' => trans('menu.destroy-menu-success'),
                'redirect' => route('admin.menu.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function up(Menu $menu)
    {
        $this->authCheck();
        $neighbor_prev = $menu->getPrevSibling();
        $menu->beforeNode($neighbor_prev)->save();
        return redirect()->back();
    }

    public function down(Menu $menu)
    {
        $this->authCheck();
        $neighbor_next = $menu->getNextSibling();
        $menu->afterNode($neighbor_next)->save();
        return redirect()->back();
    }
}
