<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function order()
    {
        if (Auth::check() && in_array(Auth::user()->type, ['admin', 'employee'])) {
            $orders = DB::table('orders as o')
                ->join('users as u', 'o.user_id', '=', 'u.id')
                ->select('o.id as order_id', 'u.name as customer_name', 'o.total_price', 'o.status', 'o.created_at')
                ->orderByDesc('o.created_at')
                ->get();

            foreach ($orders as $order) {
                $products = DB::table('order_items as oi')
                    ->join('products as p', 'oi.product_id', '=', 'p.id')
                    ->where('oi.order_id', $order->order_id)
                    ->pluck('p.name');

                $order->product_names = $products->toArray();
            }

            return view('admin.orders', compact('orders'));
        } else {
            return redirect('/login_Form');
        }
    }
}
