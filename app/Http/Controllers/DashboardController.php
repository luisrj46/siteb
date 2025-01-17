<?php

namespace App\Http\Controllers;

use App\Http\Services\Home\HomeService;
use Illuminate\Notifications\DatabaseNotification;

class DashboardController extends Controller
{

    public function __construct(private HomeService $homeService)
    {
    }

    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock','formrepeater']);
        $result = $this->homeService->index();
        return view('pages.dashboards.index', compact('result'));
    }

    public function deleteNotification(DatabaseNotification $notification)
    {
        $notification->delete();
    }
}
