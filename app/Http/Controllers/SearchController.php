<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\News;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Video;
session_start();
class SearchController extends Controller
{
    public function search(Request $request) {
        if(!isset($_GET['query']) || $_GET['query'] == null) {
            return Redirect::to('/404');
        }
        $key_word = $_GET['query'];
        $article_search_represent = DB::table('tbl_new')->select('id', 'name', 'code', 'shortdescription', 'thumbnail')->where('name', 'LIKE', '%'.$key_word.'%')->where('status', 1)->where('status_delete', 1)->first();
        $article_search = null;
        if($article_search_represent) {
            $article_search = DB::table('tbl_new')->where('name', 'LIKE', '%'.$key_word.'%')
            ->select('id', 'name', 'code', 'shortdescription', 'thumbnail', 'created_at' ,
            DB::raw('(CASE WHEN LENGTH(shortdescription) > 120 THEN CONCAT(substring(shortdescription, 1, 120), ".", "..") ELSE shortdescription END) AS shortdescription'),
            DB::raw('(CASE WHEN LENGTH(name) > 80 THEN CONCAT(substring(name, 1, 80), ".", "..") ELSE name END) AS name'))
            ->where('status', 1)->where('status_delete', 1)->where('id', '!=', $article_search_represent->id)->paginate(10);
            $article_search->appends($request->all());
        }
        
        // Menu
        $category_nav_mobi = DB::table('tbl_category')->select('id')->orderby('created_at', 'asc')->limit(11)->where('status', 1)->where('status_delete', 1)->get();
        $type_category_nav_mobi = DB::table('tbl_type_category')->select('category_id')->where('status', 1)->where('status_delete', 1)->orderby('created_at', 'asc')->get();
        $nav_category_mobi_id = [];
        foreach($category_nav_mobi as $key => $nav_category) {
          foreach($type_category_nav_mobi as $key => $nav_type_category) {
            if($nav_category->id == $nav_type_category->category_id) {
              array_push($nav_category_mobi_id, $nav_category->id);
              break;
            }
          }
        }
        $nav_category_mobi = DB::table('tbl_category')->select('id')->whereNotIn('id', $nav_category_mobi_id)
        ->where('status', 1)->where('status_delete', 1)->get();
        $category_nav = DB::table('tbl_category')->select('id', 'name', 'code')->where('status', 1)->where('status_delete', 1)->orderby('position_number', 'asc')->limit(11)->get();
        $type_category_nav = DB::table('tbl_type_category')->select('type_id', 'category_id')->where('status', 1)->where('status_delete', 1)->orderby('position_number', 'asc')->get();
        $type_nav = DB::table('tbl_type')->select('id', 'name', 'code')->where('status', 1)->where('status_delete', 1)->orderby('position_number', 'asc')->get();
        //End Menu

        // Time
        date_default_timezone_set('asia/ho_chi_minh');
        $timeEng = ['Sun','Mon','Tue','Wed', 'Thu', 'Fri', 'Sat', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
        $time = time();
        $time = date('D, d/m/Y H:i',$time);
        $time = str_replace( $timeEng, $timeVie, $time);
        // End Time

        // Tin nổi bật
        $post_featured = News::select('id', 'name', 'code',
        DB::raw('(CASE WHEN LENGTH(name) > 100 THEN CONCAT(substring(name, 1, 100), ".", "..") ELSE name END) AS name'))
        ->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
        ->orderby('view_count', 'DESC')->take(12)->get();
        // End tin nổi bật

        // Tin xem nhiều
        $post_featured_id = [];
        foreach($post_featured as $q) {
          array_push($post_featured_id, $q->id);
        }
        $post_viewed_more = News::select('id', 'name', 'code',
        DB::raw('(CASE WHEN LENGTH(name) > 100 THEN CONCAT(substring(name, 1, 100), ".", "..") ELSE name END) AS name'))
        ->whereNotIn('id', $post_featured_id)->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
        ->orderby('view_count', 'DESC')->get();
        // End Tin xem nhiều

        // Sự kiện lịch sử
        $post_historic_events_by_category_id = DB::table('tbl_new_category')->select('new_id')
        ->where('category_id', 34)->where('status', 1)->where('status_delete', 1)->get();
        $post_historic_events_id = [];
        foreach($post_historic_events_by_category_id as $q) {
          array_push($post_historic_events_id, $q->new_id);
        }
        $post_historic_events = News::select('id', 'name', 'code', 'thumbnail', 'shortdescription',
        DB::raw('(CASE WHEN LENGTH(name) > 60 THEN CONCAT(substring(name, 1, 60), ".", "..") ELSE name END) AS name'),
        DB::raw('(CASE WHEN LENGTH(shortdescription) > 100 THEN CONCAT(substring(shortdescription, 1, 100), ".", "..") ELSE shortdescription END) AS shortdescription'))
        ->whereIn('id', $post_historic_events_id)->where('status', 1)->where('accept', 1)->where('status_accept', 1)
        ->where('status_delete', 1)->get();
        // End sự kiện lịch sử

        //Seo
        $title = "Kết quả tìm kiếm cho từ khóa ".$key_word. ' | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu';
        $meta_description = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
        $meta_keywords = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
        $meta_title = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
        $canonical = $request->url();
        //End Seo

        //Video lời Bác dạy ngày này năm xưa
        $video = Video::select('name', 'code')->where('status', 1)->where('status_delete', 1)->get();
        //End Video lời Bác dạy ngày này năm xưa
        return view('search')
        ->with('category_nav', $category_nav)
        ->with('type_category_nav', $type_category_nav)
        ->with('type_nav', $type_nav)
        ->with('time', $time)
        ->with('article_search_represent', $article_search_represent)
        ->with('article_search', $article_search)
        ->with('key_word', $key_word)
        ->with('nav_category_mobi', $nav_category_mobi)
        ->with('title', $title)
        ->with('meta_description', $meta_description)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('canonical', $canonical)
        ->with('post_featured', $post_featured)
        ->with('post_viewed_more', $post_viewed_more)
        ->with('post_historic_events', $post_historic_events)
        ->with('video', $video);
    }
}
