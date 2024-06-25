<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OrderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Retrieve orders with 'success' status
        $orders = Order::where('status', 'success')->get();

        // Group orders by date and count the number of orders for each date
        $ordersByDate = $orders->groupBy(function ($order) {
            return $order->created_at->toDateString(); // Assuming you have a 'created_at' column
        });

        // Initialize arrays for labels and data
        $labels = [];
        $data = [];

        // Iterate over the grouped orders to populate labels and data
        foreach ($ordersByDate as $date => $dateOrders) {
            $labels[] = $date;
            $data[] = count($dateOrders);
        }

        return $this->chart->lineChart()
            ->setTitle('Total Orders')
            ->setSubtitle('Number of orders for each date.')
            ->addData('Total Orders', $data)
            ->setXAxis($labels);
    }
}
