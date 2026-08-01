<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        $data = Invoice::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [date('Y')])
            ->where('status', 'paid')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = [];
        $values = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = date('F', mktime(0, 0, 0, $m, 1));
            $values[] = (float) ($data[$m] ?? 0);
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Revenue (BDT)',
                    'data' => $values,
                    'borderColor' => '#4f46e5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
