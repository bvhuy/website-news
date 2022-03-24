<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use Session;
use App\Http\Requests;
use App\News;
use App\Category;
use App\Video;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
//session_start();
class HomeController extends Controller
{
    public function index(Request $request) {
      // Seo
      $title = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_description = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_keywords = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_title = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $canonical = $request->url();
      //End Seo

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
      $type_nav = DB::table('tbl_type')->select('id', 'name', 'code')->where('status', 1)->where('status_delete', 1)->get();
      //End Menu

      // Time
      date_default_timezone_set('asia/ho_chi_minh');
      $timeEng = ['Sun','Mon','Tue','Wed', 'Thu', 'Fri', 'Sat', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      $timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
      $time = time();
      $time = date('D, d/m/Y H:i',$time);
      $time = str_replace( $timeEng, $timeVie, $time);
      // End Time

      // Tin hôm nay
      $post_today_one = News::select('id', 'code', 'name', 'shortdescription', 'thumbnail',
      DB::raw('DATE(created_at) as created_date'), 
      DB::raw('(CASE WHEN LENGTH(name) > 120 THEN CONCAT(substring(name, 1, 120), ".", "..") ELSE name END) AS name'),
      DB::raw('(CASE WHEN LENGTH(shortdescription) > 190 THEN CONCAT(substring(shortdescription, 1, 190), ".", "..") ELSE shortdescription END) AS shortdescription'))
      ->orderby(DB::raw('DATE(created_at)'), 'desc')->orderby('created_at', 'desc')
      ->where('status', 1)->where('status_delete', 1)->where('status_accept', 1)
      ->where('accept', 1)->first();
      // End tin hôm nay

      // Tin hôm nay slide
      $post_today_slide = News::select('id', 'name', 'code', 'thumbnail',
      DB::raw('DATE(created_at) as created_date'),
      DB::raw('(CASE WHEN LENGTH(`tbl_new`.`name`) > 70 THEN CONCAT(substring(`tbl_new`.`name`, 1, 70), ".", "..") ELSE tbl_new.name END) AS name'))
      ->where('id', '!=', $post_today_one->id)->where('status', 1)->where('status_delete', 1)
      ->where('accept', 1)->where('status_accept', 1)->take(5)
      ->orderby(DB::raw('DATE(created_at)'), 'desc')->orderby('created_at', 'desc')->get();
      // End tin hôm nay slide

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

      //Tin Thời Sự tổng hợp
      $post_today_slide_id = [];
      foreach($post_today_slide as $q) {
        array_push($post_today_slide_id, $q->id);
      }
      $post_news_one = Cache::remember('article_random_represent',0 , function ()  use ($post_today_one, $post_today_slide_id) {
        return News::inRandomOrder()->whereNotIn('id', $post_today_slide_id)->where('id', '!=', $post_today_one->id)
        ->select('id', 'code', 'name', 'thumbnail', 'shortdescription',
        DB::raw('(CASE WHEN LENGTH(shortdescription) > 200 THEN CONCAT(substring(shortdescription, 1, 200), ".", "..") ELSE shortdescription END) AS shortdescription'),
        DB::raw('(CASE WHEN LENGTH(name) > 50 THEN CONCAT(substring(name, 1, 50), ".", "..") ELSE name END) AS name'))
        ->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)->first();
      });
      $post_news = Cache::remember('article_random',0 , function ()  use ($post_news_one, $post_today_one, $post_today_slide_id){
        return News::inRandomOrder()
        ->select('id', 'code', 'name', 'thumbnail', 'shortdescription',
        DB::raw('(CASE WHEN LENGTH(shortdescription) > 70 THEN CONCAT(substring(shortdescription, 1, 70), ".", "..") ELSE shortdescription END) AS shortdescription'),
        DB::raw('(CASE WHEN LENGTH(name) > 55 THEN CONCAT(substring(name, 1, 55), ".", "..") ELSE name END) AS name'))
        ->whereNotIn('id', $post_today_slide_id)->where('id', '!=', $post_today_one->id)->where('id', '!=', $post_news_one->id)
        ->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
        ->take(3)
        ->get();
      });
      //End Thời Sự tổng hợp

      //Video lời Bác dạy ngày này năm xưa
      $video = Video::select('name', 'code')->where('status', 1)->where('status_delete', 1)->get();
      //End Video lời Bác dạy ngày này năm xưa
      return view('pages.home')
      ->with('category_nav', $category_nav)
      ->with('type_category_nav', $type_category_nav)
      ->with('type_nav', $type_nav)
      ->with('time', $time)
      ->with('nav_category_mobi', $nav_category_mobi)
      ->with('title', $title)
      ->with('meta_description', $meta_description)
      ->with('meta_keywords', $meta_keywords)
      ->with('meta_title', $meta_title)
      ->with('canonical', $canonical)
      ->with('post_today_one', $post_today_one)
      ->with('post_today_slide', $post_today_slide)
      ->with('post_featured', $post_featured)
      ->with('post_viewed_more', $post_viewed_more)
      ->with('post_historic_events', $post_historic_events)
      ->with('post_news_one', $post_news_one)
      ->with('post_news', $post_news)
      ->with('video', $video);
    }
    public function detail_article($code, Request $request) {
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

      // Article
      $id = strrev(current(explode('-', strrev($code))));
      $str = strrev(strstr(strrev($code), '-'));
      $lenght = strlen($str);
      $code_final = substr($str, 0, $lenght-1);
      $article = News::find($id)->select('id', 'name', 'shortdescription', 'content', 'view_count', 'keywords', 'created_by', 'created_at')->where('code', $code_final)->where('status', 1)->where('status_delete', 1)->first();
      $get_category_with_new_id = DB::table('tbl_new_category')->select('category_id')
      ->where('new_id', $article->id)->where('status', 1)->where('status_delete', 1)->get();
      $category_id_article = [];
      foreach($get_category_with_new_id as $q) {
        array_push($category_id_article, $q->category_id);
      }
      $category_with_new_id = Category::inRandomOrder()->select('code', 'name')->whereIn('id', $category_id_article)->where('status', 1)->where('status_delete', 1)->first();
      $list_category_by_new_id = DB::table('tbl_new_category')->select('category_id')->where('new_id', $article->id)->where('status', 1)->where('status_delete', 1)->get();
      $category_id = [];
      foreach($list_category_by_new_id as $q) {
        array_push($category_id, $q->category_id);
      }
      $get_category_id = DB::table('tbl_new_category')->whereIn('category_id', $category_id)->distinct()->get(['new_id']);   
      $new_id = [];
      foreach($get_category_id as $q) {
        array_push($new_id, $q->new_id);
      }
      $related_articles= DB::table('tbl_new')
      ->select('id', 'name', 'code', 'thumbnail', 'shortdescription', 'created_at',
      DB::raw('(CASE WHEN LENGTH(shortdescription) > 110 THEN CONCAT(substring(shortdescription, 1, 110), ".", "..") ELSE shortdescription END) AS shortdescription'), 
      DB::raw('(CASE WHEN LENGTH(name) > 80 THEN CONCAT(substring(name, 1, 80), ".", "..") ELSE name END) AS name'))
      ->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
      ->whereIn('id', $new_id)->where('id', '!=', $article->id)->get();   
      // End Article

      // Seo
      $title = $article->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_description = $article->shortdescription;
      $meta_keywords = $article->keywords;
      $meta_title = $article->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $canonical = $request->url();
      // End Seo

      //Video lời Bác dạy ngày này năm xưa
      $video = Video::select('name', 'code')->where('status', 1)->where('status_delete', 1)->get();
      //End Video lời Bác dạy ngày này năm xưa
      Event::dispatch('posts.view', $article);
      return view('pages.article.detail_article')->with('category_nav', $category_nav)->with('type_category_nav', $type_category_nav)
      ->with('type_nav', $type_nav)->with('time', $time)
      ->with('article', $article)->with('related_articles', $related_articles)
      ->with('category_with_new_id', $category_with_new_id)->with('nav_category_mobi', $nav_category_mobi)
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
    public function detail_category($code, Request $request) {
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

      // Category
      //Lấy id category bằng code category
      $get_category_id = DB::table('tbl_category')->select('id', 'code', 'name', 'shortdescription', 'keywords')->where('code', $code)->where('status', 1)->where('status_delete', 1)->first();
      $get_new_id = DB::table('tbl_new_category')->select('new_id')->where('category_id', $get_category_id->id)->get();
      $new_id = [];
      foreach($get_new_id as $q) {
          array_push($new_id, $q->new_id);
      }
      $article_represent_by_category = DB::table('tbl_new')->select('id', 'code', 'name', 'thumbnail', 'shortdescription')->whereIn('id', $new_id)->where('status', 1)->where('status_delete', 1)->orderby('created_at', 'ASC')->first();
      $article_by_category = DB::table('tbl_new')->select('id', 'code', 'name', 'thumbnail', 'shortdescription', 'created_at',
      DB::raw('(CASE WHEN LENGTH(shortdescription) > 150 THEN CONCAT(substring(shortdescription, 1, 150), ".", "..") ELSE shortdescription END) AS shortdescription'),
      DB::raw('(CASE WHEN LENGTH(name) > 80 THEN CONCAT(substring(name, 1, 80), ".", "..") ELSE name END) AS name'))
      ->whereIn('id', $new_id)->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
      ->where('id', '!=', $article_represent_by_category->id)->paginate(10);
      // End Category

      // Seo
      $title = $get_category_id->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_description = $get_category_id->shortdescription;
      $meta_keywords = $get_category_id->keywords;
      $meta_title = $get_category_id->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $canonical = $request->url();
      // End Seo

      //Video lời Bác dạy ngày này năm xưa
      $video = Video::select('name', 'code')->where('status', 1)->where('status_delete', 1)->get();
      //End Video lời Bác dạy ngày này năm xưa
      return view('pages.category.detail_category')->with('category_nav', $category_nav)->with('type_category_nav', $type_category_nav)
      ->with('type_nav', $type_nav)->with('time', $time)
      ->with('get_category_id', $get_category_id)
      ->with('article_represent_by_category', $article_represent_by_category)->with('article_by_category', $article_by_category)
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
    public function detail_type($code_category, $code_type, Request $request) {
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
      ->whereNotIn('id', $post_featured_id)->where('status', 1)->where('accept', 1)->where('status_accept', 1)
      ->where('status_delete', 1)->orderby('view_count', 'DESC')->get();
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

      // Type
      $get_category_id = DB::table('tbl_category')->select('id', 'code', 'name')->where('code', $code_category)->where('status', 1)->where('status_delete', 1)->first();
      $get_type_id = DB::table('tbl_type')->select('id', 'code', 'name', 'shortdescription', 'keywords')->where('code', $code_type)->where('status', 1)->where('status_delete', 1)->first();
      $type_by_category_id = DB::table('tbl_type_category')->select('type_id')->where('category_id',$get_category_id->id)->where('type_id',$get_type_id->id)->where('status', 1)->where('status_delete', 1)->first();
      $get_new_id = DB::table('tbl_new_category')->select('new_id')->where('type_id', $type_by_category_id->type_id)->where('status', 1)->where('status_delete', 1)->get();
      $new_id = [];
      foreach($get_new_id as $q) {
        array_push($new_id, $q->new_id);
      }
      $article_by_type_belong_to_category_represent = DB::table('tbl_new')->select('id', 'name', 'code', 'thumbnail', 'shortdescription')
      ->whereIn('id', $new_id)->where('status', 1)->where('status_delete', 1)->orderby('created_at', 'DESC')->first();
      $article_by_type_belong_to_category = DB::table('tbl_new')->select('id', 'name', 'code', 'thumbnail', 'shortdescription', 'created_at', 
      DB::raw('(CASE WHEN LENGTH(shortdescription) > 150 THEN CONCAT(substring(shortdescription, 1, 150), ".", "..") ELSE shortdescription END) AS shortdescription'),
      DB::raw('(CASE WHEN LENGTH(name) > 80 THEN CONCAT(substring(name, 1, 80), ".", "..") ELSE name END) AS name'))
      ->whereIn('id', $new_id)->where('status', 1)->where('status_delete', 1)->where('accept', 1)->where('status_accept', 1)
      ->where('id', '!=', $article_by_type_belong_to_category_represent->id)->paginate(10);
      // End Type
      
      // Seo
      $title = $get_category_id->name." - ". $get_type_id->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_description = $get_type_id->shortdescription;
      $meta_keywords = $get_type_id->keywords;
      $meta_title = $get_category_id->name." - ". $get_type_id->name." | Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $canonical = $request->url();
      // End Seo

      //Video lời Bác dạy ngày này năm xưa
      $video = Video::select('name', 'code')->where('status', 1)->where('status_delete', 1)->get();
      //End Video lời Bác dạy ngày này năm xưa
      return view('pages.type.detail_type')->with('category_nav', $category_nav)->with('type_category_nav', $type_category_nav)
      ->with('type_nav', $type_nav)->with('time', $time)
      ->with('get_type_id', $get_type_id)->with('get_category_id', $get_category_id)
      ->with('article_by_type_belong_to_category_represent', $article_by_type_belong_to_category_represent)
      ->with('article_by_type_belong_to_category', $article_by_type_belong_to_category)->with('nav_category_mobi', $nav_category_mobi)
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
    public function errors_404(Request $request) {
      $title = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_description = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_keywords = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $meta_title = "Lực Lượng Vũ Trang Tỉnh Bà Rịa - Vũng Tàu";
      $canonical = $request->url();

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
      return view('errors.404')->with('category_nav', $category_nav)->with('type_category_nav', $type_category_nav)->with('type_nav', $type_nav)
      ->with('time', $time)->with('nav_category_mobi', $nav_category_mobi)
      ->with('title', $title)
      ->with('meta_description', $meta_description)
      ->with('meta_keywords', $meta_keywords)
      ->with('meta_title', $meta_title)
      ->with('canonical', $canonical);
    }
}
