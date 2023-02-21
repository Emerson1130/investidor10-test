<?php

namespace App\Http\Controllers\Web;

use App\Services\DashboardService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DashboardService $dashboardService)
    {
        $data = $dashboardService->getIndexData($request);

        return view('dashboard', $data);
    }
}
