<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class ChartController extends Controller
{
    // public function indexAction(UsersChart $chart){

    //     return view('dash', ['chart' => $chart->build()]);
    // }
    public function index()
    {

        $users = User::selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $months = $users->pluck('month')->toArray();
        $counts = $users->pluck('count')->toArray();


        $chart = (new LarapexChart)->lineChart()
            ->setTitle('Jumlah Pengguna Terdaftar per Bulan')
            ->setXAxis($months)
            ->addLine('Pengguna', $counts);


        return view('dash', compact('chart'));
    }
}
