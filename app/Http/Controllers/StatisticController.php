<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

use Carbon\Carbon;

class StatisticController extends Controller
{
    public function visitorsViews(Request $request)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input('dateFrom'));
        $endDate = Carbon::createFromFormat('d-m-Y', $request->input('dateTo'));
        $date = Period::create($startDate, $endDate);


        $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews($date);
        // dd($fetchTotalVisitorsAndPageViews);
        $data = [];
        $datee = [];
        $datee = $fetchTotalVisitorsAndPageViews->pluck("date");
        $data["date"] = collect($datee)->map(function ($item, $key) {
            return date('d/m/Y', strtotime($item));
        })->all();

        $data["visitors"] = $fetchTotalVisitorsAndPageViews->pluck("visitors");
        $data["pageViews"] = $fetchTotalVisitorsAndPageViews->pluck("pageViews");

        if ($request->ajax()) {
            return response()->json([
                'code' => 200,
                'data' => $data
            ], 200);
        }
    }

    public function mostVisitedPages(Request $request)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input('dateFrom'));
        $endDate = Carbon::createFromFormat('d-m-Y', $request->input('dateTo'));
        $date = Period::create($startDate, $endDate);

        $data = Analytics::fetchMostVisitedPages($date);
        $output = '';
        $i = 0;
        foreach ($data as $row) {
            $i++;
            $output .= '
            <tr>
                <td>' . $i . '</td>
                <td><p>' . $row['pageTitle'] . '</p></td>
                <td><p>' . $row['url'] . '</p></td>
                <td><p>' . $row['pageViews'] . '</p></td>
            </tr>
            ';
        }
        if ($request->ajax()) {
            return response()->json([
                'code' => 200,
                'data' => $output
            ], 200);
        }
    }
}
