<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahOrderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $order = Order::Where('status', 'success')->get();
        $cash = $order->Where('method', 'cash')->count();
        $bank = $order->Where('method', 'bank')->count();
        $cod = $order->Where('method', 'cod')->count();
        $data = [$cash, $bank, $cod];
        $label = ['cash', 'bank', 'cod'];


        return $this->chart->barChart()
            ->setTitle('Order')
            ->setSubtitle('Jumlah Order')
            ->setXAxis($label)
            ->addData('Jumlah', $data);
    }
}
