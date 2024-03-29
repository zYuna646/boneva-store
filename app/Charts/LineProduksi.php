<?php

namespace App\Charts;

use App\Models\Catalog;
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

        // Group production data by catalog ID
        $groupedData = $produksData->groupBy('catalog_id');

        $chart = $this->chart->lineChart()
            ->setTitle('Produksi Produk')
            ->setSubtitle('Quantity of production over time based on created date.');

        // Add data for each catalog ID
        foreach ($groupedData as $catalogId => $data) {
            $catalog = Catalog::find($catalogId); // Retrieve catalog information
            if ($catalog) {
                $catalogName = $catalog->name; // Get catalog name
                $quantities = $data->pluck('jumlah_produksi');
                $chart->addData($catalogName, $quantities->toArray());
            }
        }

        // Set X axis based on unique dates
        $uniqueDates = $produksData->pluck('created_at')->map(function ($date) {
            // Check if date is not null and format as 'Y-m-d H:i:s'
            return optional($date)->format('Y-m-d H:i:s');
        })->unique()->toArray();
        $chart->setXAxis($uniqueDates);

        return $chart;
    }
}
