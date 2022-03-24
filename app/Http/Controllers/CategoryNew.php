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
use App\Category;
session_start();

class CategoryNew extends Controller
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
        $str = preg_replace("/\`|\‘|\’|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_/", "", $str);
        $str = trim(preg_replace('/[\t\n\r\s]+/', ' ', $str));
        $str = str_replace(" -", "", $str);
        $str = str_replace(" ", "-", str_replace("&*#39;", "", $str));
        $str = preg_replace("/(ẻ|è|ẹ|é|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = strtolower($str);
        return $str;
    }

    // List Category
    public function list_category() {
        $this->Authentication();
        $list_category = DB::table('tbl_category')
        ->select('id', 'name', 'code', 'status', 'created_by', 'modified_by', 'created_at', 'updated_at')
        ->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        return view('admin.list_category')->with('list_category', $list_category);
    }

     // Add Category
     public function add_category() {
        $this->Authentication();
        return view('admin.add_category');
    }

    public function save_category(Request $request) {
        $this->Authentication();
        date_default_timezone_set('asia/ho_chi_minh');
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
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = '';
        //$data['position_number'] = 0;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:5|max:255'
        ],
        [
            'name.required' => 'Tên danh mục không để trống !',
            'name.min' => 'Tên danh mục tối thiểu 5 kí tự !',
            'name.max' => 'Tên danh mục tối đa 255 kí tự !',
            'shortdescription.required' => 'Mô tả ngắn không để trống !',
            'shortdescription.min' => 'Mô tả ngắn tối thiểu 3 kí tự !',
            'keywords.required' => 'Từ khóa không để trống !',
            'keywords.min' => 'Từ khóa tối thiểu 3 kí tự !',
            'keywords.max' => 'Từ khóa tối đa 255 kí tự !'
        ]);
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        else {
            DB::table('tbl_category')->insert($data);
            toast('Thêm thành công', 'success');
            return Redirect::to('/list-category');
        }
    }

    // Edit Category
    public function edit_category($id) {
        $this->Authentication();
        $edit_category = DB::table('tbl_category')
        ->select('id', 'name', 'shortdescription', 'keywords')
        ->where('id', $id)->get();
        return view('admin.edit_category')->with('edit_category', $edit_category);
    }

    public function update_category(Request $request, $id) {
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
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục không để trống !',
            'name.min' => 'Tên danh mục tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục tối đa 255 kí tự !',
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
            DB::table('tbl_category')->where('id', $id)->update($data);
            toast('Chỉnh sửa thành công', 'success');
            return Redirect::to('/list-category');
        }
    }

    // Show & Hide Category
    public function active_category($id) {
        $this->Authentication();
        DB::table('tbl_category')->where('id', $id)->update(['status' => 0]);
        DB::table('tbl_type_category')->where('category_id', $id)->update(['status' => 0]);
        DB::table('tbl_new_category')->where('category_id', $id)->update(['status' => 0]);
        $type = DB::table('tbl_type_category')->select('type_id')->where('category_id', $id)
        ->where('status', 0)->get();
        $type_id = [];
        foreach($type as $q) {
            array_push($type_id, $q->type_id);
        }
        DB::table('tbl_type')->whereIn('id', $type_id)->update(['status' => 0]);
        DB::table('tbl_new_category')->whereIn('type_id', $type_id)->update(['status' => 0]);
        // Type
        $new_by_type = DB::table('tbl_new_category')->select('new_id')
        ->whereIn('type_id', $type_id)->where('status', 0)->get();
        $new_id_by_type = [];
        foreach($new_by_type as $q) {
            array_push($new_id_by_type, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id_by_type)->update(['status' => 0]);
        //Category
        $new_by_category = DB::table('tbl_new_category')->select('new_id')
        ->where('category_id', $id)->where('status', 0)->get();
        $new_id_by_category = [];
        foreach($new_by_category as $q) {
            array_push($new_id_by_category, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id_by_category)->update(['status' => 0]);
        toast('Đã ẩn danh mục', 'success');
        return redirect()->back();
    }

    public function unactive_category($id) {
        $this->Authentication();
        DB::table('tbl_category')->where('id', $id)->update(['status' => 1]);
        DB::table('tbl_type_category')->where('category_id', $id)->update(['status' => 1]);
        DB::table('tbl_new_category')->where('category_id', $id)->update(['status' => 1]);
        $type = DB::table('tbl_type_category')->select('type_id')->where('category_id', $id)
        ->where('status', 1)->get();
        $type_id = [];
        foreach($type as $q) {
            array_push($type_id, $q->type_id);
        }
        DB::table('tbl_type')->whereIn('id', $type_id)->update(['status' => 1]);
        DB::table('tbl_new_category')->whereIn('type_id', $type_id)->update(['status' => 1]);
        // Type
        $new_by_type = DB::table('tbl_new_category')->select('new_id')
        ->whereIn('type_id', $type_id)->where('status', 1)->get();
        $new_id_by_type = [];
        foreach($new_by_type as $q) {
            array_push($new_id_by_type, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id_by_type)->update(['status' => 1]);
        //Category
        $new_by_category = DB::table('tbl_new_category')->select('new_id')
        ->where('category_id', $id)->where('status', 1)->get();
        $new_id_by_category = [];
        foreach($new_by_category as $q) {
            array_push($new_id_by_category, $q->new_id);
        }
        DB::table('tbl_new')->whereIn('id', $new_id_by_category)->update(['status' => 1]);
        toast('Đã hiển thị danh mục', 'success');
        return redirect()->back();
    }

    // Delete Category
    public function delete_category($id) {
        $this->Authentication();
        // $new = DB::table('tbl_new')->where('category_id', $id)->where('status_delete', 1)->get();
        // foreach($new as $key => $news) {
        //     $path_old = 'public/uploads/new/'.$news->thumbnail;
        //     if($path_old) {
        //         unlink($path_old);
        //     }
        // }
        $data = array();
        $data['status_delete'] = 0;

        $data_category = array();
        $data_category['status_delete'] = 0;
        $admin_name = Auth::user()->admin_name;
        $data_category['deleted_by'] = $admin_name;
        //delete category
        DB::table('tbl_category')->where('id', $id)->update($data_category);

        //delete type belongs to category
        DB::table('tbl_type_category')->where('category_id', $id)->update($data);

        //delete type
        //get list type category with status_delete = 0
        // danh sách những loại thuộc danh mục đang muốn xóa
        $list_type_category = DB::table('tbl_type_category')
        ->select('type_id')->where('category_id', $id)->where('status_delete', 0)->get();
        foreach($list_type_category as $key => $type_category) {
            $type_id = $type_category->type_id;
            $check_count_type = DB::table('tbl_type_category')
            ->select('type_id')->where('type_id', $type_id)->where('status_delete', 1)->get();
            // nếu danh sách loại đó không còn thuộc danh mục nào nữa thì xóa loại đó ra khỏi bảng type
            if(count($check_count_type) == 0) {
                DB::table('tbl_type')->where('id', $type_id)->update($data_category);
            }
        }
        
        //xóa những bài viết thuộc danh mục cần xóa
        DB::table('tbl_new_category')->where('category_id', $id)->update($data);
        //lấy danh sách bài viết đã bị xóa
        $category = DB::table('tbl_new_category')
        ->select('new_id', 'type_id')->where('category_id', $id)->where('status_delete', 0)->get();
        //duyệt vào vòng lặp

        foreach($category as $key => $categories) {
            //$check_new_id = DB::table('tbl_new_category')->where('category_id', $categories->category_id)->get();
            // ko tồn tại type_id
            if($categories->type_id == null) {
                $new_id1= $categories->new_id;
                $count_new_id1 = DB::table('tbl_new_category')
                ->select('new_id')->where('new_id', $new_id1)->where('status_delete', 1)->get();
                if(count($count_new_id1) == 0) {
                    DB::table('tbl_new')->where('id', $new_id1)->update($data_category);
                }
            }

            $new_id2= $categories->new_id;
            $type = DB::table('tbl_new_category')
            ->select('type_id')
            ->where('new_id', $new_id2)->get();
            foreach($type as $key => $types) {
                foreach($list_type_category as $key => $type_categories) {
                    if($types->type_id == $type_categories->type_id){
                        DB::table('tbl_new_category')->where('type_id', $types->type_id)->update($data);
                        $count_new_id2 = DB::table('tbl_new_category')
                        ->select('new_id')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                        if(count($count_new_id2) == 0) {
                            DB::table('tbl_new')->where('id', $new_id2)->update($data_category);
                        }
                    }
                }
            }

        }
        toast('Xóa thành công', 'success');
        return Redirect::to('/list-category');
    }

    // List Category User
    public function list_category_users() {
        $this->Authentication();
        $admin_name = Roles::find(1)->admin()->pluck('admin_name');
        $list_category_users = DB::table('tbl_category')->whereNotIn('created_by', $admin_name)->where('status_delete', 1)->distinct()->get('created_by');
        $list_category = DB::table('tbl_category')->select('id', 'name', 'created_at', 'updated_at', 'created_by', 'modified_by')
        ->where('status_delete', 1)->orderby('created_at', 'desc')->get();
        //echo $list_category_users;
        return view('admin.article-users.list_category_users')->with('list_category_users', $list_category_users)
        ->with('list_category', $list_category);
    }  

    // Add Category User
    public function add_category_users() {
        $this->Authentication();
        return view('admin.article-users.add_category_users');
    }

    public function save_category_users(Request $request) {
        $this->Authentication();
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $this->convert_vi_to_en($request->name);
        $data['shortdescription'] = $request->shortdescription;
        $data['keywords'] = $request->keywords;
        $data['status'] = 1;
        $data['status_delete'] = 1;
        $users_name = Auth::user()->admin_name;
        $data['created_by'] = $users_name;
        $data['modified_by'] = '';
        $data['deleted_by'] = '';
        date_default_timezone_set('asia/ho_chi_minh');
        $data['created_at'] = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục không để trống !',
            'name.min' => 'Tên danh mục tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục tối đa 255 kí tự !',
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
            DB::table('tbl_category')->insert($data);
            toast('Thêm thành công', 'success');
            // return redirect()->back();
            return Redirect::to('/list-category-users');
        }
       
    }

    // Edit Category
    public function edit_category_users($id) {
        $this->Authentication();
        $edit_category_users = DB::table('tbl_category')->select('id', 'name', 'shortdescription', 'keywords')->where('id', $id)->get();
        return view('admin.article-users.edit_category_users')->with('edit_category_users', $edit_category_users);
    }

    public function update_category_users(Request $request, $id) {
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
            'shortdescription' => 'required|min:3',
            'keywords' => 'required|min:3|max:255'
        ],
        [
            'name.required' => 'Tên danh mục không để trống !',
            'name.min' => 'Tên danh mục tối thiểu 3 kí tự !',
            'name.max' => 'Tên danh mục tối đa 255 kí tự !',
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
            DB::table('tbl_category')->where('id', $id)->update($data);
            toast('Chỉnh sửa thành công', 'success');
            return Redirect::to('/list-category-users');
        }
    }

    // Delete Category
    public function delete_category_users($id) {
        $this->Authentication();
        // $new = DB::table('tbl_new')->where('category_id', $id)->where('status_delete', 1)->get();
        // foreach($new as $key => $news) {
        //     $path_old = 'public/uploads/new/'.$news->thumbnail;
        //     if($path_old) {
        //         unlink($path_old);
        //     }
        // }
        $data = array();
        $data['status_delete'] = 0;
        $users_name = Auth::user()->admin_name;
        $data['deleted_by'] = $users_name;
        //delete category
        DB::table('tbl_category')->where('id', $id)->update($data);

        $data_type_category = array();
        $data_type_category['status_delete'] = 0;
        //delete type belongs to category
        DB::table('tbl_type_category')->where('category_id', $id)->update($data_type_category);

        //delete type
        //get list type category with status_delete = 0
        // danh sách những loại thuộc danh mục đang muốn xóa
        $list_type_category = DB::table('tbl_type_category')->select('type_id')->where('category_id', $id)->where('status_delete', 0)->get();
        foreach($list_type_category as $key => $type_category) {
            $type_id = $type_category->type_id;
            $check_count_type = DB::table('tbl_type_category')->select('type_id')->where('type_id', $type_id)->where('status_delete', 1)->get();
            // nếu danh sách loại đó không còn thuộc danh mục nào nữa thì xóa loại đó ra khỏi bảng type
            if(count($check_count_type) == 0) {
                DB::table('tbl_type')->where('id', $type_id)->update($data);
            }
        }
        
        //xóa những bài viết thuộc danh mục cần xóa
        DB::table('tbl_new_category')->where('category_id', $id)->update($data_type_category);
        //lấy danh sách bài viết đã bị xóa
        $category = DB::table('tbl_new_category')->select('new_id', 'type_id')->where('category_id', $id)->where('status_delete', 0)->get();
        //duyệt vào vòng lặp

        foreach($category as $key => $categories) {
            //$check_new_id = DB::table('tbl_new_category')->where('category_id', $categories->category_id)->get();
            // ko tồn tại type_id
            if($categories->type_id == null) {
                $new_id1= $categories->new_id;
                $count_new_id1 = DB::table('tbl_new_category')->select('new_id')->where('new_id', $new_id1)->where('status_delete', 1)->get();
                if(count($count_new_id1) == 0) {
                    DB::table('tbl_new')->where('id', $new_id1)->update($data);
                }
            }

            $new_id2= $categories->new_id;
            $type = DB::table('tbl_new_category')->select('type_id')->where('new_id', $new_id2)->get();
            foreach($type as $key => $types) {
                foreach($list_type_category as $key => $type_categories) {
                    if($types->type_id == $type_categories->type_id){
                        DB::table('tbl_new_category')->where('type_id', $types->type_id)->update($data_type_category);
                        $count_new_id2 = DB::table('tbl_new_category')->select('new_id')->where('new_id', $new_id2)->where('status_delete', 1)->get();
                        if(count($count_new_id2) == 0) {
                            DB::table('tbl_new')->where('id', $new_id2)->update($data);
                        }
                    }
                }
            }

        }
        toast('Xóa thành công', 'success');
        return Redirect::to('/list-category-users');
    }

    public function list_position_menu() {
        $this->Authentication();
        $category = Category::select('id', 'name', 'position_number')
        ->where('status', 1)->where('status_delete', 1)->orderby('position_number')->take(11)->get();
        return view('admin.menu.list_position_menu')->with('category', $category);
    }

    public function update_list_position() {
        $this->Authentication();
        if (isset($_POST['update'])) {
            foreach($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];
                Category::where('id', $index)->update(['position_number' => $newPosition]);
            }
            exit('success');
        }
    }
}   
