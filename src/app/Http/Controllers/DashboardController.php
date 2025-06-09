<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            $date = now()->format('Y-m-d');
        }

        $selectedDate = Carbon::parse($date);

        // Intervalo da semana anterior até o dia selecionado (7 dias)
        $startDate = $selectedDate->copy()->subDays(6); // 6 dias antes + dia selecionado = 7 dias

        // Pega vendas nesse intervalo
        $ordersByDay = Order::selectRaw('DATE(order_date) as date, SUM(total_price) as total')
            ->whereBetween('order_date', [$startDate->format('Y-m-d'), $selectedDate->format('Y-m-d')])
            ->groupBy('date')
            ->orderBy('date')
            ->toBase()
            ->get();

        // Cria um array com as datas do intervalo, para garantir label e dados completos
        $period = [];
        for ($d = $startDate->copy(); $d->lte($selectedDate); $d->addDay()) {
            $period[$d->format('Y-m-d')] = 0; // valor default zero
        }

        // Preenche os valores reais encontrados
        foreach ($ordersByDay as $orderDay) {
            $period[$orderDay->date] = (float) $orderDay->total;
        }

        // Formata labels e valores para o gráfico
        $labels = collect(array_keys($period))->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $totals = array_values($period);

        // Cores para o gráfico, destacando o dia selecionado
        $selectedDateFormatted = $selectedDate->format('d/m');
        $backgroundColors = collect($labels)->map(function ($label) use ($selectedDateFormatted) {
            return $label === $selectedDateFormatted
                ? 'rgba(6, 78, 59, 1)'
                : 'rgba(16, 185, 129, 1)';
        })->toArray();

        // Para os totais do dia selecionado
        $orders = Order::whereDate('order_date', $selectedDate->format('Y-m-d'))->get();
        $totalValue = $orders->sum('total_price');
        $totalOrders = $orders->count();

        return view('dashboard/dashboard', compact(
            'orders',
            'date',
            'totalValue',
            'totalOrders',
            'labels',
            'totals',
            'backgroundColors'
        ));
    }
}
