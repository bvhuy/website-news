<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Validator;

class VideoController extends Controller
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
        $filter = Video::getRequestFilter();
        $this->data['filter'] = $filter;
        $this->data['video'] = Video::applyFilter($filter)->with('author')->latest()->paginate($this->paginate);
        return view('admin.video.list', $this->data);
    }

    public function create()
    {
        $this->authCheck();
        $this->data['video'] = new Video();
        return view('admin.video.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->authCheck();
        $this->validate(
            $request,
            [
                'video.title'            =>    'required|max:255',
                'video.url'            =>    'nullable|url|regex:/http(?:s):\/\/(?:www\.)youtube\.com\/.+/i|max:255',
                'video.category_video_id'        =>    'required|exists:category_videos,id',
            ]
        );

        $video = new Video();
        $video->fill($request->input('video'));
        $video->author_id = auth()->user()->id;

        if ($request->hasFile('video.thumbnail')) {
            $this->validate(
                $request,
                [
                    'video.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'video.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            $file = $request->file('video.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('video.thumbnail')->storeAs('thumbnail/video', $filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $video->filename = basename($path);
            $video->thumbnail = $thumbnail;
        }

        $video->save();
        $video->categories()->sync((array) $request->input('video.category_video_id'));

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Đã thêm video mới',
                'redirect'    =>    $request->exists('save_only') ?
                    route('admin.video.edit', ['video' => $video->id]) :
                    route('admin.video.create'),
            ], 200);
        }

        if ($request->exists('save_only')) {
            return redirect()->route('admin.video.edit', ['video' => $video->id]);
        }

        return redirect()->route('admin.video.create');
    }

    public function edit(Video $video)
    {
        $this->authCheck();
        $this->data['video'] = $video;
        $this->data['video_id'] = $video->id;
        return view('admin.video.save', $this->data);
    }

    public function update(Request $request, Video $video)
    {
        $this->authCheck();
        $this->validate(
            $request,
            [
                'video.title'            =>    'required|max:255',
                'video.url'            =>    'nullable|url|regex:/http(?:s):\/\/(?:www\.)youtube\.com\/.+/i|max:255',
                'video.category_video_id'    =>    'required|exists:category_videos,id'
            ]
        );

        $data = [
            'title' => $request->input('video.title'),
            'slug' => $request->input('video.slug'),
            'url' => $request->input('video.url'),
            'author_id' => auth()->user()->id,
            'meta_title' => $request->input('video.meta_title'),
            'meta_description' => $request->input('video.meta_description'),
            'meta_keyword' => $request->input('video.meta_keyword'),
            'meta_title' => $request->input('video.meta_title')
        ];

        if ($request->hasFile('video.thumbnail')) {
            $this->validate(
                $request,
                [
                    'video.thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'video.thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );
            Storage::disk('public')->delete('thumbnail/video/' . $video->filename);
            $file = $request->file('video.thumbnail');
            $filename = uniqid() . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $request->file('video.thumbnail')->storeAs('thumbnail/video', $filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($path);
            $data['filename'] = basename($path);
            $data['thumbnail'] = $thumbnail;
        }

        $video->update($data);
        $video->categories()->sync((array) $request->input('video.category_video_id'));

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Đã cập nhật video',
            ];
            if ($request->exists('save_and_out')) {
                $response['redirect'] = route('admin.video.index');
            }

            if ($request->exists('save_only')) {
                $response['redirect'] = route('admin.video.edit', ['video' => $video->id]);
            }

            return response()->json($response, 200);
        }

        if ($request->exists('save_and_out')) {
            return redirect()->route('admin.video.index');
        }

        return redirect()->back();
    }

    public function disable(Request $request, Video $video)
    {
        $this->authCheck();
        $video->markAsDisable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.disable-video-success'),
                'redirect'    =>    route('admin.video.index')
            ], 200);
        }

        return redirect()->back();
    }

    public function enable(Request $request, Video $video)
    {
        $this->authCheck();
        $video->markAsEnable();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.enable-video-success'),
                'redirect'    =>    route('admin.video.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, Video $video)
    {
        $this->authCheck();
        Storage::disk('public')->delete('thumbnail/video/' . $video->filename);
        $video->delete();
        if ($request->ajax()) {
            return response()->json([
                'title'            =>    trans('cms.success'),
                'message'        =>    trans('video.destroy-video-success'),
                'redirect'    =>    route('admin.video.index')
            ], 200);
        }
        return redirect()->back();
    }

    public function upload(Request $request)
    {
        $this->authCheck();
        // if ($request->hasFile('video.thumbnail')) {
        //     // $file = $request->file('video.thumbnail');
        //     // $filename = $file->getClientOriginalName();
        //     // $folder = uniqid() . '-' . now()->timestamp;
        //     // $file->storeAs('post/' . $folder, $filename);
        //     // return $folder;
        //     $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        //     $path = $filepond->getPathFromServerId($request->file('video.thumbnail'));
        //     $finalLocation = public_path('/post');
        //     \File::move($path, $finalLocation);
        //     return $path;
        // }
        // return '';
    }
}
