<?php

namespace App\Charts;

use App\Models\Bahan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BahanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $bahan = Bahan::all();
        $data = [];
        $label = [];

        foreach ($bahan as $value) {
            $data[] = $value->jumlah;
            $label[] = $value->name;
        }

        return $this->chart->barChart()
            ->setTitle('Bahan Baku')
            ->setSubtitle('Jumlah Bahan Baku')
            ->setXAxis($label)
            ->addData('Jumlah', $data);
    }
}
