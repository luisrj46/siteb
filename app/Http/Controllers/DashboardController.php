<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock','formrepeater']);

        return view('pages.dashboards.index');
    }
}
