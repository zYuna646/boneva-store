<?php

namespace App\Charts;

use App\Models\Catalog;
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
        $bahan = Catalog::all();
        $data = [];
        $label = [];

        foreach ($bahan as $value) {
            $data[] = $value->stock;
            $label[] = $value->name;
        }

        return $this->chart->barChart()
            ->setTitle('Product')
            ->setSubtitle('Jumlah Product')
            ->setXAxis($label)
            ->addData('Jumlah', $data);
    }
}
