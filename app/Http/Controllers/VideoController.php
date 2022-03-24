<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Video;
class VideoController extends Controller
{
    public function Authentication() {
        $id = Auth::id();
        if($id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }

    public function add_video() {
        $this->Authentication();
        return view('admin.video.add');
    }

    public function save_video(Request $request) {
        $this->Authentication();
        date_default_timezone_set('asia/ho_chi_minh');
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $request->code;
        $data['status'] = $request->status;
        $data['status_delete'] = 1;
        $admin_name = Auth::user()->admin_name;
        $data['created_by'] = $admin_name;
        $data['created_at'] = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:11|max:11'
        ],
        [
            'name.required' => 'Tên Video không để trống !',
            'name.min' => 'Tên Video tối thiểu 3 kí tự !',
            'name.max' => 'Tên Video tối đa 255 kí tự !',
            'code.required' => 'Code không để trống !',
            'code.min' => 'Tên code tối thiểu 11 kí tự !',
            'code.max' => 'Tên code tối đa 11 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        } else {
            $video = new Video();
            $video->name = $data['name'];
            $video->code = $data['code'];
            $video->status = $data['status'];
            $video->status_delete = $data['status_delete'];
            $video->created_by = $data['created_by'];
            $video->created_at = $data['created_at'];
            $video->save();
            toast('Thêm Video thành công', 'success');
            return Redirect::to('/add-video');
        }
    }

    public function list_video() {
        $this->Authentication();
        $video = Video::select('id', 'name', 'code', 'status', 'created_at', 'updated_at', 'created_by', 'modified_by')
        ->where('status_delete', 1)->get();
        return view('admin.video.list')->with('video', $video);
    }

    public function edit_video($id) {
        $this->Authentication();
        $video = Video::where('id', $id)->get();
        return view('admin.video.edit')->with('video', $video);
    }

    public function update_video(Request $request, $id) {
        $this->Authentication();
        date_default_timezone_set('asia/ho_chi_minh');
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $request->code;
        $admin_name = Auth::user()->admin_name;
        $data['modified_by'] = $admin_name;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:11|max:11'
        ],
        [
            'name.required' => 'Tên Video không để trống !',
            'name.min' => 'Tên Video tối thiểu 3 kí tự !',
            'name.max' => 'Tên Video tối đa 255 kí tự !',
            'code.required' => 'Code không để trống !',
            'code.min' => 'Tên code tối thiểu 11 kí tự !',
            'code.max' => 'Tên code tối đa 11 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        } else {
            Video::where('id', $id)->update($data);
            toast('Chỉnh sửa Video thành công', 'success');
            return Redirect::to('/list-video');
        }
    }

    public function delete_video($id){
        $admin_name = Auth::user()->admin_name;
        Video::where('id', $id)->update(['status_delete' => 0, 'deleted_by' => $admin_name]);
        toast('Xóa Video thành công', 'success');
        return Redirect::to('/list-video');
    }

    public function active_video($id) {
        $this->Authentication();
        Video::where('id', $id)->update(['status' => 0]);
        toast('Đã ẩn Video', 'success');
        return redirect()->back();
    }

    public function unactive_video($id) {
        $this->Authentication();
        Video::where('id', $id)->update(['status' => 1]);
        toast('Đã hiện Video', 'success');
        return redirect()->back();
    }
}
