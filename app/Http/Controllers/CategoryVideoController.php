<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryVideo;
use Illuminate\Support\Facades\Storage;
use Validator;

class CategoryVideoController extends Controller
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
        $this->data['categories'] = CategoryVideo::defaultOrder()->get()->toTree();
        return view('admin.category_video.list', $this->data);
    }

    public function create()
    {
        $this->authCheck();
        $this->data['category'] = new CategoryVideo();
        return view('admin.category_video.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate($request, [
            'category.name'        => 'required|max:255',
            'category.slug'            => 'max:255'
        ]);

        $data = [
            'name' => $request->input('category.name'),
            'slug' => $request->input('category.slug'),
            'meta_title' => $request->input('category.meta_title'),
            'meta_description' => $request->input('category.meta_description'),
            'meta_keyword' => $request->input('category.meta_keyword'),
            'meta_title' => $request->input('category.meta_title'),
            'parent_id' => $request->input('category.parent_id')
        ];

        if ($request->hasFile('category.thumbnail')) {
            $this->validate(
                $request,
                [
                    'category.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'category.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            $file = $request->file('category.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('category.thumbnail')->storeAs('thumbnail/danh-muc-video', $filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $data['filename'] = basename($path);
            $data['thumbnail'] = $thumbnail;
        }

        $category = new CategoryVideo($data);
        $category->save();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm danh mục mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.category.video.edit', ['category' => $category->id]) :
                    route('admin.category.video.create'),
            ]);
        }

        if ($request->exists('save_only')) {
            return redirect(route('admin.category.video.edit', ['category' => $category->id]));
        }

        return redirect(route('admin.category.video.create'));
    }

    public function edit(CategoryVideo $category)
    {
        $this->authCheck();
        $this->data['category'] = $category;
        $this->data['category_id'] = $category->id;
        return view('admin.category_video.save', $this->data);
    }

    public function update(Request $request, CategoryVideo $category)
    {
        $this->authCheck();
        $this->validate(
            $request,
            [
                'category.name'        => 'required|max:255',
                'category.slug'            => 'max:255'
            ]
        );

        $data = [
            'name' => $request->input('category.name'),
            'slug' => $request->input('category.slug'),
            'meta_title' => $request->input('category.meta_title'),
            'meta_description' => $request->input('category.meta_description'),
            'meta_keyword' => $request->input('category.meta_keyword'),
            'meta_title' => $request->input('category.meta_title'),
            'parent_id' => $request->input('category.parent_id')
        ];

        if ($request->hasFile('category.thumbnail')) {
            $this->validate(
                $request,
                [
                    'category.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'category.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            Storage::disk('public')->delete('thumbnail/danh-muc-video/' . $category->filename);

            $file = $request->file('category.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('category.thumbnail')->storeAs('thumbnail/danh-muc-video', $filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $data['filename'] = basename($path);
            $data['thumbnail'] = $thumbnail;
        }


        $category->update($data);

        if ($request->ajax()) {
            $response = [
                'title'      =>    'Thành công',
                'message'    =>    'Đã cập nhật danh mục',
            ];
            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.category.video.index');
            }

            if ($request->exists('save_only')) {
                $response['redirect'] = route('admin.category.video.edit', ['category' => $category->id]);
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.category.video.index');
        }

        return redirect()->back();
    }

    public function disable(Request $request, CategoryVideo $category)
    {
        $this->authCheck();
        $category->markAsDisable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.category.disable-category-success'),
                'redirect'    =>    route('admin.category.video.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function enable(Request $request, CategoryVideo $category)
    {
        $this->authCheck();
        $category->markAsEnable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.category.enable-category-success'),
                'redirect'    =>    route('admin.category.video.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, CategoryVideo $category)
    {
        $this->authCheck();

        if ($category->videos()->count()) {
            if ($request->ajax()) {
                return response()->json([
                    'title'        =>    trans('cms.error'),
                    'message'    =>    trans('video.category.category-has-video'),
                    'redirect'    =>    route('admin.category.video.index')
                ], 422);
            }

            return redirect()->back();
        }

        Storage::disk('public')->delete('thumbnail/danh-muc-video/' . $category->filename);
        $category->delete();

        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.category.destroy-category-success'),
                'redirect'    =>    route('admin.category.video.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function up(CategoryVideo $category)
    {
        $this->authCheck();
        $neighbor_prev = $category->getPrevSibling();
        $category->beforeNode($neighbor_prev)->save();
        return redirect()->back();
    }

    public function down(CategoryVideo $category)
    {
        $this->authCheck();
        $neighbor_next = $category->getNextSibling();
        $category->afterNode($neighbor_next)->save();
        return redirect()->back();
    }
}
