<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class AdminController extends AppController
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
        $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(31));
        // dd($fetchTotalVisitorsAndPageViews);
        $data = [];
        $data["date"] = $fetchTotalVisitorsAndPageViews->pluck("date");
        $data["visitors"] = $fetchTotalVisitorsAndPageViews->pluck("visitors");
        $data["pageViews"] = $fetchTotalVisitorsAndPageViews->pluck("pageViews");

        $data["mostVisitedPages"] = Analytics::fetchMostVisitedPages(Period::days(31));

        // $data = array();
        // foreach ($fetchTotalVisitorsAndPageViews as $key => $rs) {
        //     $data[] = [
        //         'date' => $rs['date'] = date("d-m-Y"),
        //         'pageViews' => $rs['pageViews']
        //     ];
        // }

        // dd(json_encode($data));

        // $data1["data"] = $data;

        return view('admin.dashboard', $data);
    }

    public function tinymce()
    {
        $this->authCheck();
        return view('vendor.file-manager.tinymce');
    }
}
