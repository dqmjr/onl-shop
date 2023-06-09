<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        return view('place');
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(['orderId' => $order]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }
        else {
            $order->products()->attach($productId);
        }

        return redirect(route('basket'));
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect(route('basket'));
        }
        $order = Order::find($orderId);
        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            }
            else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return redirect(route('basket'));
    }
}
