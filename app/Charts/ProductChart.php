<?php

namespace App\Charts;

use App\Models\Catalog;
use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProductChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $bahan = Catalog::with('produks')->get();
        $bahan->each(function ($catalog) {
            $catalog->totalStocks = $catalog->stock + $catalog->produks->sum('jumlah_produksi');
            $orders = Order::whereRaw("JSON_EXTRACT(items, '$.\"{$catalog->id}\"') IS NOT NULL")->get();
            foreach ($orders as $order) {
                $itemsJson = json_decode($order->items, true);
                if (isset($itemsJson[$catalog->id])) {
                    $quantity = $itemsJson[$catalog->id];
                    $catalog->totalStocks -= $quantity;
                }
            }
        });
        $data = [];
        $label = [];

        foreach ($bahan as $value) {
            $data[] = $value->totalStocks;
            $label[] = $value->name;
        }

        return $this->chart->barChart()
            ->setTitle('Product')
            ->setSubtitle('Jumlah Product')
            ->setXAxis($label)
            ->addData('Jumlah', $data);
    }
}
