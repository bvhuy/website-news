<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\News;
use Auth;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
session_start();

class NewController extends Controller
{
    
    public function Authentication() {
        $id = Auth::id();
        if($id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }

    public function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        $str = preg_replace("/\`|\‘|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_/", "", $str);
        $str = trim(preg_replace('/[\t\n\r\s]+/', ' ', $str));
        $str = str_replace(" -", "", $str);
        $str = str_replace(" ", "-", str_replace("&*#39;", "", $str));
        $str = preg_replace("/(ẻ|è|ẹ|é|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = strtolower($str);
        return $str;
    }
    // USERS
    public function list_new_users() {
        $this->Authentication();
        //$admin_name = Roles::find(1)->admin()->pluck('admin_name');
        // $list_new_users = DB::table('tbl_new')
        // ->whereNotIn('created_by', $admin_name)
        // ->where('status_delete', 1)
        // ->distinct()
        // ->get('created_by');
        $users_name = Auth::user()->admin_name;
        $list_new = News::orderBy('created_at', 'DESC')
        ->select('id', 'name', 'thumbnail', 'accept', 'created_at', 'updated_at', 'created_by', 'modified_by', 'status_new_users',
        DB::raw('(CASE WHEN LENGTH(name) > 25 THEN CONCAT(substring(name, 1, 25), ".", "..") ELSE name END) AS name'))
        ->where('created_by', $users_name)->where('status_delete', 1)->get();
        $list_new_category = DB::table('tbl_new_category')->select('new_id', 'type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $list_type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->get();
        return view('admin.article-users.list_new_users')->with('list_new', $list_new)->with('list_new_category', $list_new_category)
        ->with('list_category', $list_category)->with('list_type', $list_type);
    }

    public function add_new_users() {
        $this->Authentication();
        $category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        $type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        return view('admin.article-users.add_new_users')->with('category', $category)->with('type', $type);
    }

    public function save_new_users(Request $request) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['content'] = $request->content;
        $data['status'] = 1;
        $data['status_delete'] = 1;
        $users_name = Auth::user()->admin_name;
        $data['created_by'] = $users_name;
        $data['modified_by'] = '';
        $data['deleted_by'] = '';
        $data['accept'] = 0;
        $data['status_accept'] = 0;
        $data['status_new_users'] = 0;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['created_at'] = date('Y-m-d H:i:s');
        $date_today = date('Y-m-d-H-i-s');
        $thumbnail = $request->file('thumbnail');

        if($request->category_id != null && $request->type_id == null){
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }
            else {
                //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                $data['thumbnail'] = $new_image; // Add new image
                DB::table('tbl_new')->insert($data);
    
                // Get row data new after add database
                $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                $data_new_category = array();
                
                foreach($request->category_id as $key => $category_id) {
                    $data_new_category['new_id'] = $new->id;
                    $data_new_category['category_id'] = $category_id;
                    $data_new_category['created_at'] = date('Y-m-d H:i:s');
                    $data_new_category['status'] = 1;
                    $data_new_category['status_delete'] = 1;
                    DB::table('tbl_new_category')->insert($data_new_category);
                }
                toast('Thêm thành công', 'success');
                return redirect()->back();
            } 
        } else if($request->category_id == null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }
            else {
                //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                $data['thumbnail'] = $new_image; // Add new image
                DB::table('tbl_new')->insert($data);
    
                // Get row data new after add database
                $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                $data_new_category = array();
                
                foreach($request->type_id as $key => $type_id) {
                    $data_new_category['new_id'] = $new->id;
                    $data_new_category['type_id'] = $type_id;
                    $data_new_category['created_at'] = date('Y-m-d H:i:s');
                    $data_new_category['status'] = 1;
                    $data_new_category['status_delete'] = 1;
                    DB::table('tbl_new_category')->insert($data_new_category);
                }
                toast('Thêm thành công', 'success');
                return redirect()->back();
                }
            } else if($request->category_id != null && $request->type_id != null) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:10|max:255',
                    'thumbnail' => 'required',
                    'shortdescription' => 'required|min:50',
                    'content' => 'required|min:150',
                    'keywords' => 'required|min:3|max:255'
                ],
                [
                    'name.required' => 'Tên bài viết không để trống !',
                    'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                    'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                    'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                    'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                    'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                    'content.required' => 'Nội dung không để trống !',
                    'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                    'keywords.required' => 'Từ khóa bài viết không để trống !',
                    'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                    'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
                ]
                );
                if ($validator->fails()) {
                    toast($validator->messages()->all()[0], 'error');
                    return redirect()->back()->withInput();
                }
                else {
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                    DB::table('tbl_new')->insert($data);
        
                    // Get row data new after add database
                    $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                    $data_category = array();
                    //if($request->category_id != null) {
                        foreach($request->category_id as $key => $category_id) {
                            $data_category['new_id'] = $new->id;
                            $data_category['category_id'] = $category_id;
                            $data_category['created_at'] = date('Y-m-d H:i:s');
                            $data_category['status'] = 1;
                            $data_category['status_delete'] = 1;
                            DB::table('tbl_new_category')->insert($data_category);
                        }
                    //}
                    $data_type = array();
                    //if($request->type_id != null) {
                        foreach($request->type_id as $key => $type_id) {
                            $data_type['new_id'] = $new->id;
                            $data_type['type_id'] = $type_id;
                            $data_type['created_at'] = date('Y-m-d H:i:s');
                            $data_type['status'] = 1;
                            $data_type['status_delete'] = 1;
                            DB::table('tbl_new_category')->insert($data_type);
                        }
                    //}
                    toast('Thêm thành công', 'success');
                    return redirect()->back();
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'category_id' => 'required',
                'type_id' => 'required',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung tối thiếu 150 kí tự !',
                'category_id.required' => 'Chưa chọn danh mục !',
                'type_id.required' => 'Chưa chọn danh mục con !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }         
        }
    }

    public function edit_new_users($id) {
        $this->Authentication();
        $users_name = Auth::user()->admin_name;
        $articleById = News::where('id', $id)->select('id')->where('created_by', $users_name)->first();
        if($articleById == null) {
            return redirect('/dashboard');
        }
        $list_new_category = DB::table('tbl_new_category')->select('new_id', 'type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $list_type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->get();
        $edit_new = News::where('id', $id)->select('id', 'name', 'thumbnail', 'shortdescription', 'content', 'keywords')->where('status_delete', 1)->get();
        return view('admin.article-users.edit_new_users')->with('edit_new', $edit_new)->with('list_new_category', $list_new_category)
        ->with('list_category', $list_category)->with('list_type', $list_type);
    }

    
    public function update_new_users(Request $request, $id) {
        $this->Authentication();
        $users_name = Auth::user()->admin_name;
        $articleById = News::where('id', $id)->select('id')->where('created_by', $users_name)->first();
        if($articleById == null) {
            return redirect('/dashboard');
        }
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['content'] = $request->content;
        $data['modified_by'] = $users_name;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $date_today = date('Y-m-d-H-i-s');
        $thumbnail = $request->file('thumbnail');
        if($request->category_id != null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    unlink($path_old);
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category
                $data_category = array();
                $data_category['new_id'] = $id;
                
                $category_id_value = [];
                $list_type_null = DB::table('tbl_new_category')->select('category_id')->where('new_id', $id)->where('type_id', null)->get();
                foreach($list_type_null as $key => $new_category){
                    $category_id_value[] = $new_category->category_id;
                }
                
                
                foreach($request->category_id as $key => $category_id) {
                    if(!in_array($category_id, $category_id_value)){
                        //echo $category_id." insert";
                        $data_category['category_id'] = $category_id;
                        $data_category['status'] = 1;
                        $data_category['status_delete'] = 1;
                        $data_category['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_category);
                    }
                }
    
                foreach($category_id_value as $key => $category_id_row) {
                    if(!in_array($category_id_row, $request->category_id)) {
                        //echo $category_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', $category_id_row)->delete();
                    }
                }

                // type
                
                $data_type = array();
                $data_type['new_id'] = $id;

                $type_id_value = [];
                $list_category_null = DB::table('tbl_new_category')->select('type_id')->where('new_id', $id)->where('category_id', null)->get();
                foreach($list_category_null as $key => $new_type){
                    $type_id_value[] = $new_type->type_id;
                }
                
                
                foreach($request->type_id as $key => $type_id) {
                    if(!in_array($type_id, $type_id_value)){
                        //echo $type_id." insert";
                        $data_type['type_id'] = $type_id;
                        $data_type['status'] = 1;
                        $data_type['status_delete'] = 1;
                        $data_type['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_type);
                    }
                }
    
                foreach($type_id_value as $key => $type_id_row) {
                    if(!in_array($type_id_row, $request->type_id)) {
                        //echo $type_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', $type_id_row)->delete();
                    }
                }
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();            
            }
        } else if($request->category_id != null && $request->type_id == null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    unlink($path_old);
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category
                $data_category = array();
                $data_category['new_id'] = $id;
                
                $category_id_value = [];
                $list_type_null = DB::table('tbl_new_category')->select('category_id')->where('new_id', $id)->where('type_id', null)->get();
                foreach($list_type_null as $key => $new_category){
                    $category_id_value[] = $new_category->category_id;
                }
                
                
                foreach($request->category_id as $key => $category_id) {
                    if(!in_array($category_id, $category_id_value)){
                        //echo $category_id." insert";
                        $data_category['category_id'] = $category_id;
                        $data_category['status'] = 1;
                        $data_category['status_delete'] = 1;
                        $data_category['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_category);
                    }
                }
    
                foreach($category_id_value as $key => $category_id_row) {
                    if(!in_array($category_id_row, $request->category_id)) {
                        //echo $category_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', $category_id_row)->delete();
                    }
                }

                // type
                DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', null)->delete();
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();           
            }
        } else if($request->category_id == null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    unlink($path_old);
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category

                DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', null)->delete();
                
                // type
                
                $data_type = array();
                $data_type['new_id'] = $id;

                $type_id_value = [];
                $list_category_null = DB::table('tbl_new_category')->select('type_id')->where('new_id', $id)->where('category_id', null)->get();
                foreach($list_category_null as $key => $new_type){
                    $type_id_value[] = $new_type->type_id;
                }
                
                
                foreach($request->type_id as $key => $type_id) {
                    if(!in_array($type_id, $type_id_value)){
                        //echo $type_id." insert";
                        $data_type['type_id'] = $type_id;
                        $data_type['status'] = 1;
                        $data_type['status_delete'] = 1;
                        $data_type['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_type);
                    }
                }
    
                foreach($type_id_value as $key => $type_id_row) {
                    if(!in_array($type_id_row, $request->type_id)) {
                        //echo $type_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', $type_id_row)->delete();
                    }
                }
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();        
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:10|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'category_id' => 'required',
                'type_id' => 'required',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 10 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung tối thiếu 150 kí tự !',
                'category_id.required' => 'Chưa chọn danh mục !',
                'type_id.required' => 'Chưa chọn danh mục con !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }         
        }
    }

    public function active_new_users($id) {
        $this->Authentication();
        $users_name = Auth::user()->admin_name;
        $articleById = News::where('id', $id)->select('id')->where('created_by', $users_name)->first();
        if($articleById == null) {
            return redirect('/dashboard');
        }

        DB::table('tbl_new')->where('id', $id)->update(['status_new_users' => 0]);
        toast('Thu hồi bài viết thành công', 'success');
        return redirect()->back();
    }

    public function unactive_new_users($id) {
        $this->Authentication();
        $users_name = Auth::user()->admin_name;
        $articleById = News::where('id', $id)->select('id')->where('created_by', $users_name)->first();
        if($articleById == null) {
            return redirect('/dashboard');
        }
        DB::table('tbl_new')->where('id', $id)->update(['status_new_users' => 1]);
        toast('Nộp bài viết thành công', 'success');
        return redirect()->back();
    }

    public function delete_new_users($id) {
        $this->Authentication();
        //Xóa ảnh ra khỏi source
        // $new = DB::table('tbl_new')->where('id', $id)->first();
        // $path_old = 'public/uploads/new/'.$new->thumbnail;
        // if($path_old) {
        //     unlink($path_old);
        // }
        $users_name = Auth::user()->admin_name;
        $articleById = News::where('id', $id)->select('id')->where('created_by', $users_name)->first();
        if($articleById == null) {
            return redirect('/dashboard');
        }
        $data = array();
        $data['status_delete'] = 0;
        
        $data_new = array();
        $data_new['status_delete'] = 0;
        $data_new['deleted_by'] = $users_name;
        DB::table('tbl_new')->where('id', $id)->update($data_new);

        DB::table('tbl_new_category')->where('new_id', $id)->update($data);

        toast('Xóa thành công', 'success');
        return redirect()->back();
    }
    // END USERS

    // ADMIN
    public function list_new() {
        $this->Authentication();
        $list_new = News::orderBy('created_at', 'DESC')
        ->select('id', 'name', 'thumbnail', 'view_count', 'status', 'created_by', 'modified_by', 'created_at', 'updated_at', 'content')
        ->where('accept', 1)->where('status_delete', 1)->where('status_new_users', 0)->get();
        $list_new_category = DB::table('tbl_new_category')->select('new_id', 'type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $list_type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->get();
        return view('admin.list_new')->with('list_new', $list_new)->with('list_new_category', $list_new_category)
        ->with('list_category', $list_category)->with('list_type', $list_type);
    }

    public function add_new() {
        $this->Authentication();
        $category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        $type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        return view('admin.add_new')->with('category', $category)->with('type', $type);
    }

    public function save_new(Request $request) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['content'] = $request->content;
        $data['status'] = $request->status;
        $data['status_delete'] = 1;
        $data['accept'] = 1;
        $admin_name = Auth::user()->admin_name;
        $data['created_by'] = $admin_name;
        $data['modified_by'] = '';
        $data['deleted_by'] = '';
        $data['status_accept'] = 1;
        $data['status_new_users'] = 0;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['created_at'] = date('Y-m-d H:i:s');
        $date_today = date('Y-m-d-H-i-s');
        $thumbnail = $request->file('thumbnail');

        if($request->category_id != null && $request->type_id == null){
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }
            else {
                //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                $data['thumbnail'] = $new_image; // Add new image
                DB::table('tbl_new')->insert($data);
    
                // Get row data new after add database
                $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                $data_new_category = array();
               
                foreach($request->category_id as $key => $category_id) {
                    $data_new_category['new_id'] = $new->id;
                    $data_new_category['category_id'] = $category_id;
                    $data_new_category['created_at'] = date('Y-m-d H:i:s');
                    $data_new_category['status'] = 1;
                    $data_new_category['status_delete'] = 1;
                    DB::table('tbl_new_category')->insert($data_new_category);
                }
                toast('Thêm thành công', 'success');
                return redirect()->back();
            } 
        } else if($request->category_id == null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }
            else {
                //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                $data['thumbnail'] = $new_image; // Add new image
                DB::table('tbl_new')->insert($data);
    
                // Get row data new after add database
                $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                $data_new_category = array();
               
                foreach($request->type_id as $key => $type_id) {
                    $data_new_category['new_id'] = $new->id;
                    $data_new_category['type_id'] = $type_id;
                    $data_new_category['created_at'] = date('Y-m-d H:i:s');
                    $data_new_category['status'] = 1;
                    $data_new_category['status_delete'] = 1;
                    DB::table('tbl_new_category')->insert($data_new_category);
                }
                toast('Thêm thành công', 'success');
                return redirect()->back();
                }
            } else if($request->category_id != null && $request->type_id != null) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:30|max:255',
                    'thumbnail' => 'required',
                    'shortdescription' => 'required|min:50',
                    'content' => 'required|min:150',
                    'keywords' => 'required|min:3|max:255'
                ],
                [
                    'name.required' => 'Tên bài viết không để trống !',
                    'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                    'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                    'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                    'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                    'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                    'content.required' => 'Nội dung không để trống !',
                    'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                    'keywords.required' => 'Từ khóa bài viết không để trống !',
                    'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                    'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
                ]
                );
                if ($validator->fails()) {
                    toast($validator->messages()->all()[0], 'error');
                    return redirect()->back()->withInput();
                }
                else {
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                    DB::table('tbl_new')->insert($data);
        
                    // Get row data new after add database
                    $new = DB::table('tbl_new')->select('id')->orderby('id', 'desc')->limit(1)->first();
                    $data_category = array();
                    //if($request->category_id != null) {
                        foreach($request->category_id as $key => $category_id) {
                            $data_category['new_id'] = $new->id;
                            $data_category['category_id'] = $category_id;
                            $data_category['created_at'] = date('Y-m-d H:i:s');
                            $data_category['status'] = 1;
                            $data_category['status_delete'] = 1;
                            DB::table('tbl_new_category')->insert($data_category);
                        }
                    //}
                    $data_type = array();
                    //if($request->type_id != null) {
                        foreach($request->type_id as $key => $type_id) {
                            $data_type['new_id'] = $new->id;
                            $data_type['type_id'] = $type_id;
                            $data_type['created_at'] = date('Y-m-d H:i:s');
                            $data_type['status'] = 1;
                            $data_type['status_delete'] = 1;
                            DB::table('tbl_new_category')->insert($data_type);
                        }
                    //}
                    toast('Thêm thành công', 'success');
                    return redirect()->back();
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'thumbnail' => 'required',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'category_id' => 'required',
                'type_id' => 'required',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'thumbnail.required' => 'Hình ảnh chưa được chọn !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung tối thiếu 150 kí tự !',
                'category_id.required' => 'Chưa chọn danh mục !',
                'type_id.required' => 'Chưa chọn danh mục con được chọn !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }         
        }
    }

    public function edit_new($id) {
        $this->Authentication();
        $list_new_category = DB::table('tbl_new_category')->select('new_id', 'type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $list_type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->get();
        $edit_new = News::where('id', $id)->select('id', 'name', 'thumbnail', 'shortdescription', 'content', 'keywords')->where('status_delete', 1)->get();
        return view('admin.edit_new')->with('edit_new', $edit_new)->with('list_new_category', $list_new_category)
        ->with('list_category', $list_category)->with('list_type', $list_type);
    }

    public function update_new(Request $request, $id) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['content'] = $request->content;
        $admin_name = Auth::user()->admin_name;
        $data['modified_by'] = $admin_name;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $date_today = date('Y-m-d-H-i-s');
        $thumbnail = $request->file('thumbnail');
        if($request->category_id != null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    if($path_old) {
                        unlink($path_old);
                    }
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category
                $data_category = array();
                $data_category['new_id'] = $id;
                
                $category_id_value = [];
                $list_type_null = DB::table('tbl_new_category')->select('category_id')->where('new_id', $id)->where('type_id', null)->get();
                foreach($list_type_null as $key => $new_category){
                    $category_id_value[] = $new_category->category_id;
                }
                
                
                foreach($request->category_id as $key => $category_id) {
                    if(!in_array($category_id, $category_id_value)){
                        //echo $category_id." insert";
                        $data_category['category_id'] = $category_id;
                        $data_category['status'] = 1;
                        $data_category['status_delete'] = 1;
                        $data_category['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_category);
                    }
                }
    
                foreach($category_id_value as $key => $category_id_row) {
                    if(!in_array($category_id_row, $request->category_id)) {
                        //echo $category_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', $category_id_row)->delete();
                    }
                }

                // type
                
                $data_type = array();
                $data_type['new_id'] = $id;

                $type_id_value = [];
                $list_category_null = DB::table('tbl_new_category')->select('type_id')->where('new_id', $id)->where('category_id', null)->get();
                foreach($list_category_null as $key => $new_type){
                    $type_id_value[] = $new_type->type_id;
                }
                
                
                foreach($request->type_id as $key => $type_id) {
                    if(!in_array($type_id, $type_id_value)){
                        //echo $type_id." insert";
                        $data_type['type_id'] = $type_id;
                        $data_type['status'] = 1;
                        $data_type['status_delete'] = 1;
                        $data_type['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_type);
                    }
                }
    
                foreach($type_id_value as $key => $type_id_row) {
                    if(!in_array($type_id_row, $request->type_id)) {
                        //echo $type_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', $type_id_row)->delete();
                    }
                }
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();            
            }
        } else if($request->category_id != null && $request->type_id == null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    unlink($path_old);
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category
                $data_category = array();
                $data_category['new_id'] = $id;
                
                $category_id_value = [];
                $list_type_null = DB::table('tbl_new_category')->select('category_id')->where('new_id', $id)->where('type_id', null)->get();
                foreach($list_type_null as $key => $new_category){
                    $category_id_value[] = $new_category->category_id;
                }
                
                
                foreach($request->category_id as $key => $category_id) {
                    if(!in_array($category_id, $category_id_value)){
                        //echo $category_id." insert";
                        $data_category['category_id'] = $category_id;
                        $data_category['status'] = 1;
                        $data_category['status_delete'] = 1;
                        $data_category['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_category);
                    }
                }
    
                foreach($category_id_value as $key => $category_id_row) {
                    if(!in_array($category_id_row, $request->category_id)) {
                        //echo $category_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', $category_id_row)->delete();
                    }
                }

                // type
                DB::table('tbl_new_category')->where('new_id', $id)->where('category_id', null)->delete();
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();           
            }
        } else if($request->category_id == null && $request->type_id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung bài viết tối thiếu 150 kí tự !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            } else {
                if($thumbnail) {
                    $new = DB::table('tbl_new')->select('thumbnail')->where('id', $id)->first();
                    $thumbnail_old = $new->thumbnail;
                    $path_old = 'public/uploads/new/'.$thumbnail_old;
                    unlink($path_old);
                    //$thumbnail_name_image = $thumbnail->getClientOriginalName(); // Get name image & name extension
                    //$name_image = current(explode('.',  $thumbnail_name_image)); // Get name image
                    $new_image = $data['code'].'-'.rand(1, 999).'-'. $date_today.'.'.$thumbnail->getClientOriginalExtension(); // New name image
                    $thumbnail->move('public/uploads/new', $new_image); // Move image to public/uploads/new
                    $data['thumbnail'] = $new_image; // Add new image
                }
                DB::table('tbl_new')->where('id', $id)->update($data);
                

                // category

                DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', null)->delete();
                
                // type
                
                $data_type = array();
                $data_type['new_id'] = $id;

                $type_id_value = [];
                $list_category_null = DB::table('tbl_new_category')->select('type_id')->where('new_id', $id)->where('category_id', null)->get();
                foreach($list_category_null as $key => $new_type){
                    $type_id_value[] = $new_type->type_id;
                }
                
                
                foreach($request->type_id as $key => $type_id) {
                    if(!in_array($type_id, $type_id_value)){
                        //echo $type_id." insert";
                        $data_type['type_id'] = $type_id;
                        $data_type['status'] = 1;
                        $data_type['status_delete'] = 1;
                        $data_type['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('tbl_new_category')->insert($data_type);
                    }
                }
    
                foreach($type_id_value as $key => $type_id_row) {
                    if(!in_array($type_id_row, $request->type_id)) {
                        //echo $type_id_row." delete";
                        DB::table('tbl_new_category')->where('new_id', $id)->where('type_id', $type_id_row)->delete();
                    }
                }
    
                toast('Chỉnh sửa thành công', 'success');
                return redirect()->back();        
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:30|max:255',
                'shortdescription' => 'required|min:50',
                'content' => 'required|min:150',
                'category_id' => 'required',
                'type_id' => 'required',
                'keywords' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'Tên bài viết không để trống !',
                'name.min' => 'Tên bài viết tối thiểu 30 kí tự !',
                'name.max' => 'Tên bài viết tối đa 255 kí tự !',
                'shortdescription.required' => 'Tóm tắt bài viết không để trống !',
                'shortdescription.min' => 'Tóm tắt bài viết tối thiếu 50 kí tự !',
                'content.required' => 'Nội dung không để trống !',
                'content.min' => 'Nội dung tối thiếu 150 kí tự !',
                'category_id.required' => 'Chưa chọn danh mục !',
                'type_id.required' => 'Chưa chọn danh mục con !',
                'keywords.required' => 'Từ khóa bài viết không để trống !',
                'keywords.min' => 'Từ khóa bài viết tối thiểu 3 kí tự !',
                'keywords.max' => 'Từ khóa bài viết tối đa 255 kí tự !'
            ]
            );
            if ($validator->fails()) {
                toast($validator->messages()->all()[0], 'error');
                return redirect()->back()->withInput();
            }         
        }
    }

    public function active_new($id) {
        $this->Authentication();

        DB::table('tbl_new')->where('id', $id)->update(['status' => 0]);
        toast('Đã ẩn bài viết', 'success');
        return redirect()->back();
    }

    public function unactive_new($id) {
        $this->Authentication();
        DB::table('tbl_new')->where('id', $id)->update(['status' => 1]);
        toast('Đã hiển thị bài viết', 'success');
        return redirect()->back();
    }

    public function delete_new($id) {
        $this->Authentication();
        //Xóa ảnh ra khỏi source
        // $new = DB::table('tbl_new')->where('id', $id)->first();
        // $path_old = 'public/uploads/new/'.$new->thumbnail;
        // if($path_old) {
        //     unlink($path_old);
        // }
        $data = array();
        $data['status_delete'] = 0;
        $data_new = array();
        $data_new['status_delete'] = 0;
        $admin_name = Auth::user()->admin_name;
        $data_new['deleted_by'] = $admin_name;
        DB::table('tbl_new')->where('id', $id)->update($data_new);

        DB::table('tbl_new_category')->where('new_id', $id)->update($data);

        toast('Xóa thành công', 'success');
        return redirect()->back();
    }

    public function list_new_accept() {
        $this->Authentication();
        $list_new = News::orderBy('created_at', 'DESC')
        ->select('id', 'name', 'thumbnail', 'accept', 'created_by', 'created_at', 'status_accept', 'content')
        ->where('status_new_users', 1)->where('status_delete', 1)->get();
        $list_new_category = DB::table('tbl_new_category')->select('new_id', 'type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $list_type = DB::table('tbl_type')->select('id', 'name')->where('status_delete', 1)->get();
        return view('admin.article-accept.list_new_accept')->with('list_new', $list_new)->with('list_new_category', $list_new_category)
        ->with('list_category', $list_category)->with('list_type', $list_type);
    }

    public function refuse_new($id) {
        $this->Authentication();
        DB::table('tbl_new')->where('id', $id)->update(['accept' => 2]);
        toast('Đã từ chối bài viết', 'error');
        return redirect()->back();
    }

    public function accept_new($id) {
        $this->Authentication();
        DB::table('tbl_new')->where('id', $id)->update(['accept' => 1]);
        toast('Đã chấp nhận bài viết', 'success');
        return redirect()->back();
    }
    public function unactive_status_accept_new($id) {
        $this->Authentication();
        DB::table('tbl_new')->where('id', $id)->update(['status_accept' => 1]);
        toast('Đã hiển thị bài viết', 'success');
        return redirect()->back();
    }

    public function active_status_accept_new($id) {
        $this->Authentication();
        DB::table('tbl_new')->where('id', $id)->update(['status_accept' => 0]);
        toast('Đã ẩn bài viết', 'success');
        return redirect()->back();
    }
    //END ADMIN



    public function file_browser(Request $request){
        $this->Authentication();
        $paths = glob(public_path('uploads/ckeditor/*'));

        $fileNames = array();

        foreach($paths as $path){
            array_push($fileNames,basename($path));
        }
        $data = array(
            'fileNames' => $fileNames
        );
       
        return view('admin.images.file_browser')->with($data);
   }
   public function ckeditor_image(Request $request){
    $this->Authentication();
    if($request->hasFile('upload')) {

         $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
         $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName.'_'.time().'.'.$extension;
         $request->file('upload')->move('public/uploads/ckeditor', $fileName);

         $CKEditorFuncNum = $request->input('CKEditorFuncNum');
         $url = asset('public/uploads/ckeditor/'.$fileName); 
         $msg = 'Tải ảnh thành công';
         $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
         @header('Content-type: text/html; charset=utf-8'); 
         echo $response;
         

     }
 }
}
