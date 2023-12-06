<?php

namespace App\Charts;

use App\Models\Produks;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LineProduksi
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Fetch production data from the database
        $produksData = Produks::all();

        // Extract dates and corresponding production quantities
        $dates = $produksData->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d'); // Format the date as needed
        });

        $quantities = $produksData->pluck('jumlah_produksi');

        // Display data for debugging

        // Build the chart
        return $this->chart->lineChart()
            ->setTitle('Produksi Produk')
            ->setSubtitle('Quantity of production over time based on created date.')
            ->addData('Jumlah Produksi Produk', $quantities->toArray())
            ->setXAxis($dates->toArray());
    }
}
