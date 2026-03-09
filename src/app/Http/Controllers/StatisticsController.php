<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
public function index()
{
    // $userId = auth()->id();
    $currentYear = date('Y');

    // Statystyki miesięczne z uwzględnieniem typu (Przychód vs Wydatek)
    $monthlyStats = Expenses::select(
            DB::raw('strftime("%m", date) as month'),
            DB::raw('SUM(CASE WHEN category_id = 1 THEN -amount ELSE amount END) as total')
        )
        // ->where('user_id', $userId)
        ->whereRaw('strftime("%Y", date) = ?', [$currentYear])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Suma całkowita (Saldo roczne)
    $yearlyBalance = $monthlyStats->sum('total');
    $yearlyAverage = $yearlyBalance / 12;

    $currentMonth = date('m');
    $currentMonthSum = $monthlyStats->where('month', $currentMonth)->first()->total ?? 0;

    // Mapowanie danych do widoku
    $monthlyStats = $monthlyStats->map(function ($item) use ($yearlyAverage) {
        $item->month_name = \Carbon\Carbon::create()->month((int)$item->month)->translatedFormat('F');
        
        $item->color = $item->total > $yearlyAverage ? 'green' : 'red';
        $item->percentage_diff = $yearlyAverage != 0 
            ? round((($item->total - $yearlyAverage) / abs($yearlyAverage)) * 100, 2) 
            : 0;
            
        return $item;
    });

    $expenses = Expenses::where('user_id')->latest()->simplePaginate(5);

    return view('statistics.index', compact('currentMonthSum', 'yearlyAverage', 'monthlyStats', 'expenses'));
}
}