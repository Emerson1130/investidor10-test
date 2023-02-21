<?php

namespace App\Http\Controllers\Web;

use App\Services\DashboardService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DashboardService $dashboardService)
    {
        $data = $dashboardService->getIndexData();

        return view('dashboard', $data);
    }
}
