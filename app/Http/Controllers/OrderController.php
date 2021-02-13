<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use function fclose;
use function fopen;
use function fputcsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        Gate::authorize('view','orders');

        $order = Order::paginate();

        return OrderResource::collection($order);
    }

    public function show($id)
    {
        Gate::authorize('view','orders');

        return new OrderResource(Order::find($id));
    }

    public function export()
    {
        Gate::authorize('view','orders');

        $headers = [
            "content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma" => "no-cache",
            "Cache-control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $orders = Order::all();
            $file = fopen('php://output', 'w');

            //header row
            fputcsv($file, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);

            //body
            foreach ($orders as $order) {
                fputcsv($file, [$order->id, $order->name, $order->email, '', '', '']);

                foreach ($order->orderItems as $orderItem) {
                    fputcsv($file, ['', '', '', $orderItem->product_title, $orderItem->price,  $orderItem->quantity]);
                }
            }

            fclose($file);

        };

        return \Response::stream($callback, 200, $headers);
    }
}
