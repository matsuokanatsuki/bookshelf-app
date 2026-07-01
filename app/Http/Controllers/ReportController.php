<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function index(ReportService $reportService)
    {
        $stats = $reportService->getUserStats(auth()->user());

        return view('reports.index', compact('stats'));
    }
}