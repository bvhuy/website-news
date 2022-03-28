<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Validator;

class NewsController extends AppController
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
        $filter = News::getRequestFilter();
        $this->data['filter'] = $filter;
        $this->data['news'] = News::applyFilter($filter)->with('author')->latest()->paginate($this->paginate);
        return view('admin.news.list', $this->data);
    }

    public function create()
    {
        $this->authCheck();
        $this->data['news'] = new News();
        return view('admin.news.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate(
            $request,
            [
                'news.title'            =>    'required|max:255',
                'news.content'            =>    'min:0',
                'news.description'            =>    'min:0',
                'news.category_id'        =>    'required|exists:categories,id',
            ]
        );

        $news = new News();
        $news->fill($request->input('news'));
        $news->author_id = auth()->user()->id;

        if ($request->hasFile('news.thumbnail')) {
            $this->validate(
                $request,
                [
                    'news.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'news.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            $file = $request->file('news.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('news.thumbnail')->storeAs('thumbnail/bai-viet', $filename, 'public');
            // Storage::disk('s3')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $news->filename = basename($path);
            $news->thumbnail = $thumbnail;
        }

        // $news->content = $request->input('news.content');
        $news->hot = $request->has('news.hot') ? 1 : 0;
        $news->event = $request->has('news.event') ? 1 : 0;
        $news->save();
        $news->categories()->sync((array) $request->input('news.category_id'));

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm bài viết mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.news.edit', ['news' => $news->id]) :
                    route('admin.news.create'),
            ], 200);
        }

        if ($request->exists('save_only')) {
            return redirect()->route('admin.news.edit', ['news' => $news->id]);
        }

        return redirect()->route('admin.news.create');
    }

    public function edit(News $news)
    {
        $this->authCheck();
        $this->data['news'] = $news;
        $this->data['news_id'] = $news->id;
        return view('admin.news.save', $this->data);
    }

    public function update(Request $request, News $news)
    {
        $this->authCheck();
        $this->validate(
            $request,
            [
                'news.title'            =>    'required|max:255',
                'news.content'        =>    'min:0',
                'news.description'            =>    'min:0',
                'news.category_id'    =>    'required|exists:categories,id'
            ]
        );

        $data = [
            'title' => $request->input('news.title'),
            'slug' => $request->input('news.slug'),
            'content' => $request->input('news.content'),
            'description' => $request->input('news.description'),
            'hot' => $request->has('news.hot') ? 1 : 0,
            'event' => $request->has('news.event') ? 1 : 0,
            'author_id' => auth()->user()->id,
            'meta_title' => $request->input('news.meta_title'),
            'meta_description' => $request->input('news.meta_description'),
            'meta_keyword' => $request->input('news.meta_keyword'),
            'meta_title' => $request->input('news.meta_title')
        ];

        if ($request->hasFile('news.thumbnail')) {
            $this->validate(
                $request,
                [
                    'news.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'news.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            Storage::disk('public')->delete('thumbnail/bai-viet/' . $news->filename);
            $file = $request->file('news.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('news.thumbnail')->storeAs('thumbnail/bai-viet', $filename, 'public');
            // Storage::disk('s3')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $data['filename'] = basename($path);
            $data['thumbnail'] = $thumbnail;
        }

        $news->update($data);
        $news->categories()->sync((array) $request->input('news.category_id'));

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Đã cập nhật bài viết',
            ];
            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.news.index');
            }

            if ($request->exists('save_only')) {
                $response['redirect'] = route('admin.news.edit', ['news' => $news->id]);
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.news.index');
        }

        return redirect()->back();
    }

    public function disable(Request $request, News $news)
    {
        $this->authCheck();
        $news->markAsDisable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('news.disable-news-success'),
                'redirect'    =>    route('admin.news.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function enable(Request $request, News $news)
    {
        $this->authCheck();
        $news->markAsEnable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('news.enable-news-success'),
                'redirect'    =>    route('admin.news.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, News $news)
    {
        $this->authCheck();
        Storage::disk('public')->delete('thumbnail/bai-viet/' . $news->filename);
        $news->delete();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('news.destroy-news-success'),
                'redirect'    =>    route('admin.news.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function upload(Request $request)
    {
        $this->authCheck();
        // if ($request->hasFile('news.thumbnail')) {
        //     // $file = $request->file('news.thumbnail');
        //     // $filename = $file->getClientOriginalName();
        //     // $folder = uniqid() . '-' . now()->timestamp;
        //     // $file->storeAs('post/' . $folder, $filename);
        //     // return $folder;
        //     $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        //     $path = $filepond->getPathFromServerId($request->file('news.thumbnail'));
        //     $finalLocation = public_path('/post');
        //     \File::move($path, $finalLocation);
        //     return $path;
        // }
        // return '';
    }
}
