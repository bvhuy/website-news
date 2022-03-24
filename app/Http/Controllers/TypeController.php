<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use App\Admin;
use App\Roles;
use App\Type;
use App\Category;
session_start();
class TypeController extends Controller
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

    // add type
    public function add_type() {
        $this->Authentication();
        $list_category = DB::table('tbl_category')
        ->select('id', 'name')
        ->where('status', 1)->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        return view('admin.add_type')->with('list_category', $list_category);
    }

    // add type users
    public function add_type_users() {
        $this->Authentication();
        $list_category = DB::table('tbl_category')
        ->select('id', 'name')
        ->where('status', 1)->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        return view('admin.article-users.add_type_users')->with('list_category', $list_category);
    }

    public function save_type_users(Request $request) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['status'] = $request->status;
        $data['status_delete'] = 1;
        $users_name = Auth::user()->admin_name;
        $data['created_by'] = $users_name;
        $data['modified_by'] = '';
        $data['deleted_by'] = '';
        date_default_timezone_set('asia/ho_chi_minh');
        $data['created_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3:max:255',
            'category_id' => 'required',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục con không để trống !',
            'name.min' => 'Tên danh mục con tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục con tối đa 255 kí tự !',
            'category_id.required' => 'Thanh menu chưa được chọn !',
            'shortdescription.required' => 'Mô tả ngắn không để trống !',
            'shortdescription.min' => 'Mô tả ngắn tối thiểu 3 kí tự !',
            'keywords.required' => 'Từ khóa không để trống !',
            'keywords.min' => 'Từ khóa tối thiểu 3 kí tự !',
            'keywords.max' => 'Từ khóa tối đa 255 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        else {
            DB::table('tbl_type')->insert($data);

            $new = DB::table('tbl_type')->orderby('id', 'desc')->limit(1)->first();
            $data_type_category = array();
           
            foreach($request->category_id as $key => $category_id) {
                $data_type_category['type_id'] = $new->id;
                $data_type_category['category_id'] = $category_id;
                $data_type_category['created_at'] = date('Y-m-d H:i:s');
                $data_type_category['status'] = 1;
                $data_type_category['status_delete'] = 1;
                DB::table('tbl_type_category')->insert($data_type_category);
            }
            toast('Thêm thành công', 'success');
            return Redirect::to('/list-type-users');
        } 
    }

    public function save_type(Request $request) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['status'] = $request->status;
        $data['status_delete'] = 1;
        $admin_name = Auth::user()->admin_name;
        $data['created_by'] = $admin_name;
        $data['modified_by'] = '';
        $data['deleted_by'] = '';
        date_default_timezone_set('asia/ho_chi_minh');
        $data['created_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'category_id' => 'required',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục con không để trống !',
            'name.min' => 'Tên danh mục con tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục con tối đa 255 kí tự !',
            'category_id.required' => 'Thanh menu chưa được chọn !',
            'shortdescription.required' => 'Mô tả ngắn không để trống !',
            'shortdescription.min' => 'Mô tả ngắn tối thiểu 3 kí tự !',
            'keywords.required' => 'Từ khóa không để trống !',
            'keywords.min' => 'Từ khóa tối thiểu 3 kí tự !',
            'keywords.max' => 'Từ khóa tối đa 255 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        else {
            DB::table('tbl_type')->insert($data);

            $new = DB::table('tbl_type')->orderby('id', 'desc')->limit(1)->first();
            $data_type_category = array();
           
            foreach($request->category_id as $key => $category_id) {
                $data_type_category['type_id'] = $new->id;
                $data_type_category['category_id'] = $category_id;
                $data_type_category['created_at'] = date('Y-m-d H:i:s');
                $data_type_category['status'] = 1;
                $data_type_category['status_delete'] = 1;
                DB::table('tbl_type_category')->insert($data_type_category);
            }
            toast('Thêm thành công', 'success');
            return Redirect::to('/list-type');
            // return redirect()->back();
        } 
    }

    public function list_type() {
        $this->Authentication();
        $list_type = DB::table('tbl_type')->select('id', 'name', 'created_at', 'updated_at', 'status', 'created_by', 'modified_by')
        ->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        $list_type_category = DB::table('tbl_type_category')->select('type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        return view('admin.list_type')->with('list_type', $list_type)->with('list_type_category', $list_type_category)->with('list_category', $list_category);
    }

    public function list_type_users() {
        $this->Authentication();
        $list_type = DB::table('tbl_type')->select('id', 'name', 'created_at', 'updated_at', 'status', 'created_by', 'modified_by')->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        $admin_name = Roles::find(1)->admin()->pluck('admin_name');
        $list_type_users = DB::table('tbl_type')->select('created_by')->whereNotIn('created_by', $admin_name)->where('status_delete', 1)->distinct()->get('created_by');
        
        $list_type_category = DB::table('tbl_type_category')->select('type_id', 'category_id')->where('status_delete', 1)->get();

        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        
        return view('admin.article-users.list_type_users')
        ->with('list_type', $list_type)
        ->with('list_type_users', $list_type_users)
        ->with('list_type_category', $list_type_category)
        ->with('list_category', $list_category);
    }

    // edit type
    public function edit_type($id) {
        $this->Authentication();
        $list_type_category = DB::table('tbl_type_category')->select('type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $edit_type = DB::table('tbl_type')->select('id', 'name', 'shortdescription', 'keywords')->where('id', $id)->where('status_delete', 1)->get();
        return view('admin.edit_type')->with('edit_type', $edit_type)->with('list_type_category', $list_type_category)->with('list_category', $list_category);
    }

    // edit type users
    public function edit_type_users($id) {
        $this->Authentication();
        $list_type_category = DB::table('tbl_type_category')->select('type_id', 'category_id')->where('status_delete', 1)->get();
        $list_category = DB::table('tbl_category')->select('id', 'name')->where('status_delete', 1)->get();
        $edit_type = DB::table('tbl_type')->select('id', 'name', 'shortdescription', 'keywords')->where('id', $id)->where('status_delete', 1)->get();
        return view('admin.article-users.edit_type_users')
        ->with('edit_type', $edit_type)
        ->with('list_type_category', $list_type_category)
        ->with('list_category', $list_category);
    }

    public function update_type(Request $request, $id) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $admin_name = Auth::user()->admin_name;
        $data['modified_by'] = $admin_name;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'category_id' => 'required',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục con không để trống !',
            'name.min' => 'Tên danh mục con tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục con tối đa 255 kí tự !',
            'category_id.required' => 'Thanh menu chưa được chọn !',
            'shortdescription.required' => 'Mô tả ngắn không để trống !',
            'shortdescription.min' => 'Mô tả ngắn tối thiểu 3 kí tự !',
            'keywords.required' => 'Từ khóa tối không để trống !',
            'keywords.min' => 'Từ khóa tối thiểu 3 kí tự !',
            'keywords.max' => 'Từ khóa tối đa 255 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }else {
            DB::table('tbl_type')->where('id', $id)->update($data);
            
            $data_type_category = array();
            $data_type_category['type_id'] = $id;

            $category_id_value = [];
            $list_type_category = DB::table('tbl_type_category')->where('type_id', $id)->get();
            foreach($list_type_category as $key => $type_category){
                $category_id_value[] = $type_category->category_id;
            }
            
            
            foreach($request->category_id as $key => $category_id) {
                if(!in_array($category_id, $category_id_value)){
                    //echo $category_id." insert";
                    $data_type_category['category_id'] = $category_id;
                    $data_type_category['status'] = 1;
                    $data_type_category['status_delete'] = 1;
                    $data_type_category['created_at'] = date('Y-m-d H:i:s');
                    DB::table('tbl_type_category')->insert($data_type_category);
                }
            }

            foreach($category_id_value as $key => $category_id_row) {
                if(!in_array($category_id_row, $request->category_id)) {
                    //echo $category_id_row." delete";
                    DB::table('tbl_type_category')->where('type_id', $id)->where('category_id', $category_id_row)->delete();
                }
            }

            toast('Cập nhật thành công', 'success');
            // return redirect()->back();    
            return Redirect::to('/list-type');        
        }
        
    }

    //update type users
    public function update_type_users(Request $request, $id) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $users_name = Auth::user()->admin_name;
        $data['modified_by'] = $users_name;
        date_default_timezone_set('asia/ho_chi_minh');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'category_id' => 'required',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục con không để trống !',
            'name.min' => 'Tên danh mục con tối thiểu 3 kí tự !', 
            'name.max' => 'Tên danh mục con tối đa 255 kí tự !',
            'category_id.required' => 'Thanh menu chưa được chọn !',
            'shortdescription.required' => 'Mô tả ngắn không để trống !',
            'shortdescription.min' => 'Mô tả ngắn tối thiểu 3 kí tự !',
            'keywords.required' => 'Từ khóa không để trống !',
            'keywords.min' => 'Từ khóa tối thiểu 3 kí tự !',
            'keywords.max' => 'Từ khóa tối đa 255 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }else {
            DB::table('tbl_type')->where('id', $id)->update($data);
            
            $data_type_category = array();
            $data_type_category['type_id'] = $id;

            $category_id_value = [];
            $list_type_category = DB::table('tbl_type_category')->where('type_id', $id)->get();
            foreach($list_type_category as $key => $type_category){
                $category_id_value[] = $type_category->category_id;
            }
            
            
            foreach($request->category_id as $key => $category_id) {
                if(!in_array($category_id, $category_id_value)){
                    //echo $category_id." insert";
                    $data_type_category['category_id'] = $category_id;
                    $data_type_category['status'] = 1;
                    $data_type_category['status_delete'] = 1;
                    $data_type_category['created_at'] = date('Y-m-d H:i:s');
                    DB::table('tbl_type_category')->insert($data_type_category);
                }
            }

            foreach($category_id_value as $key => $category_id_row) {
                if(!in_array($category_id_row, $request->category_id)) {
                    //echo $category_id_row." delete";
                    DB::table('tbl_type_category')->where('type_id', $id)->where('category_id', $category_id_row)->delete();
                }
            }

            toast('Cập nhật thành công', 'success');
            // return redirect()->back();    
            return Redirect::to('/list-type-users');        
        }
        
    }

     // Show & Hide type
     public function active_type($id) {
        $this->Authentication();
        DB::table('tbl_type')->where('id', $id)->update(['status' => 0]);
        DB::table('tbl_type_category')->where('type_id', $id)->update(['status' => 0]);
        DB::table('tbl_new_category')->where('type_id', $id)->update(['status' => 0]);
        $new = DB::table('tbl_new_category')->select('new_id')->where('type_id', $id)->where('status', 0)->get();
        $new_id = [];
        foreach($new as $q) {
            array_push($new_id, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id)->update(['status' => 0]);
        toast('Đã ẩn danh mục con', 'success');
        return redirect()->back();
    }

    public function unactive_type($id) {
        $this->Authentication();
        DB::table('tbl_type')->where('id', $id)->update(['status' => 1]);
        DB::table('tbl_type_category')->where('type_id', $id)->update(['status' => 1]);
        DB::table('tbl_new_category')->where('type_id', $id)->update(['status' => 1]);
        $new = DB::table('tbl_new_category')->select('new_id')->where('type_id', $id)->where('status', 1)->get();
        $new_id = [];
        foreach($new as $q) {
            array_push($new_id, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id)->update(['status' => 1]);
        toast('Đã hiển thị danh mục con', 'success');
        return redirect()->back();
    }

    // Delete type
    public function delete_type($id) {
        $this->Authentication();
        $data = array();
        $data['status_delete'] = 0;
        $data_type = array();
        $data_type['status_delete'] = 0;
        $admin_name = Auth::user()->admin_name;
        $data_type['deleted_by'] = $admin_name;
        DB::table('tbl_type')->where('id', $id)->update($data_type);
        DB::table('tbl_type_category')->where('type_id', $id)->update($data);

        DB::table('tbl_new_category')->where('type_id', $id)->update($data);
        $type = DB::table('tbl_new_category')->select('new_id', 'category_id')->where('type_id', $id)->where('status_delete', 0)->get();
        foreach($type as $key => $types) {
            //tìm những bài viết ko có danh mục để xóa ra khỏi bảng new_category
            // ko ton tai category_id
            if($types->category_id == null) {
                $new_id1= $types->new_id;
                $count_new_id1 = DB::table('tbl_new_category')->where('new_id', $new_id1)->where('status_delete', 1)->get();
                if(count($count_new_id1) == 0) {
                    DB::table('tbl_new')->where('id', $new_id1)->update($data_type);
                }
            }
            //7

            // ton tai category
            $new_id2= $types->new_id;

            //lay 4 thang 7
            //ds id = 8
            $category = DB::table('tbl_new_category')->where('new_id', $new_id2)->get();
            foreach($category as $key => $categories) {

                $count_new_id2 = DB::table('tbl_new_category')->select('new_id')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                if(count($count_new_id2) == 0) {
                    DB::table('tbl_new')->where('id', $new_id2)->update($data_type);
                }

                // foreach($type as $key => $type_categories) {
                //     if($categories->type_id == $type_categories->type_id){
                //         DB::table('tbl_new_category')->where('type_id', $types->type_id)->update($data);
                //         $count_new_id2 = DB::table('tbl_new_category')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                //         if(count($count_new_id2) == 0) {
                //             DB::table('tbl_new')->where('id', $new_id2)->update($data);
                //         }
                //         //DB::table('tbl_new')->where('id', $new_id2)->update($data);
                //     }
                // }
            }
        }
        toast('Xóa thành công', 'success');
        // return redirect()->back();
        return Redirect::to('/list-type');
    }

    public function delete_type_users($id) {
        $this->Authentication();
        $data = array();
        $data['status_delete'] = 0;

        $data_type = array();
        $data_type['status_delete'] = 0;
        $users_name = Auth::user()->admin_name;
        $data_type['deleted_by'] = $users_name;

        DB::table('tbl_type')->where('id', $id)->update($data_type);
        
        DB::table('tbl_type_category')->where('type_id', $id)->update($data);

        DB::table('tbl_new_category')->where('type_id', $id)->update($data);
        $type = DB::table('tbl_new_category')->where('type_id', $id)->where('status_delete', 0)->get();
        foreach($type as $key => $types) {
            //tìm những bài viết ko có danh mục để xóa ra khỏi bảng new_category
            // ko ton tai category_id
            if($types->category_id == null) {
                $new_id1= $types->new_id;
                $count_new_id1 = DB::table('tbl_new_category')->where('new_id', $new_id1)->where('status_delete', 1)->get();
                if(count($count_new_id1) == 0) {
                    DB::table('tbl_new')->where('id', $new_id1)->update($data_type);
                }
            }
            //7

            // ton tai category
            $new_id2= $types->new_id;

            //lay 4 thang 7
            //ds id = 8
            $category = DB::table('tbl_new_category')->where('new_id', $new_id2)->get();
            foreach($category as $key => $categories) {

                $count_new_id2 = DB::table('tbl_new_category')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                if(count($count_new_id2) == 0) {
                    DB::table('tbl_new')->where('id', $new_id2)->update($data_type);
                }

                // foreach($type as $key => $type_categories) {
                //     if($categories->type_id == $type_categories->type_id){
                //         DB::table('tbl_new_category')->where('type_id', $types->type_id)->update($data);
                //         $count_new_id2 = DB::table('tbl_new_category')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                //         if(count($count_new_id2) == 0) {
                //             DB::table('tbl_new')->where('id', $new_id2)->update($data);
                //         }
                //         //DB::table('tbl_new')->where('id', $new_id2)->update($data);
                //     }
                // }
            }
        }
        toast('Xóa thành công', 'success');
        // return redirect()->back();
        return Redirect::to('/list-type-users');
    }


    public function edit_menu_sub($id) {
        $this->Authentication();
        $category = DB::table('tbl_category')->select('id', 'name')->where('id', $id)->first();
        $type_category = DB::table('tbl_type_category')->where('category_id', $id)->where('status', 1)->where('status_delete', 1)->get();
        $type_id = [];
        foreach($type_category as $q) {
            array_push($type_id, $q->type_id);
        }
        $type = Type::whereIn('id', $type_id)->where('status', 1)->where('status_delete', 1)->get();
        return view('admin.menu.edit_menu_sub')
        ->with('category', $category)
        ->with('type', $type);
    }

    public function update_menu_sub(Request $request) {
        $this->Authentication();
        if (isset($_POST['update'])) {
            foreach($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];
                //Category::where('id', $index)->update(['position_number' => $newPosition]);
                DB::table('tbl_type_category')->where('type_id', $index)
                ->where('category_id', $request->category_id)->update(['position_number' => $newPosition]);
            }
            exit('success-menu-sub');
        }
    }
}
