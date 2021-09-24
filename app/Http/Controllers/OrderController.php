<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        $orders = Order::where('user_id', $currentUser->id)->get();
        return response()->json(array(
            'data' => $orders,
            'error' => null,
        ), 200);
    }
    private function getTracking()
    {

        $random = Str::random(8);

        $matchingOrder = $orders = Order::where('tracking', $random)
            ->first();

        $final_tracking = $random;

        while ($matchingOrder !== null) {
            $random = Str::random(8);
            $matchingOrder = $orders = Order::where('tracking', $random)
                ->first();
            $final_tracking = $random;
        }
        return strtoupper($final_tracking);
    }
    public function get($id)
    {
        $currentUser = Auth::user();


        $order = Order::where('id', $id)
            ->where('user_id', $currentUser->id)
            ->first();
        if ($order === null) {
            return response()->json(array(
                'data' => null,
                'error' => "You cannot access the specified order",
            ), 404);
        }

        $order->eta = $order->getEstimatedDelivery();
        return response()->json(array(
            'data' => $order,
            'error' => null,
        ), 200);
    }

    public function getByTracking($id)
    {

        $order = Order::where('tracking', $id)
            ->first();

        if ($order === null) {
            return response()->json(array(
                'data' => null,
                'error' => "You cannot access the specified order",
            ), 404);
        }
        $order->eta = $order->getEstimatedDelivery();
        return response()->json(array(
            'data' => $order,
            'error' => null,
        ), 200);
    }

    public function post(Request $request)
    {


        $request->validate([
            'order_data' => 'required|array|min:1',
        ]);
        $currentUser = Auth::user();


        $order_items = [];
        foreach ($request->order_data as $order_item) {
            $item =  Food::find($order_item['id']);
            $order_items[] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $order_item['quantity'],
                'photo_url' => $item->photo_url
            ];
        }

        $tracking = $this->getTracking();
        try {
            $order = Order::create([
                'user_id' => $currentUser->id,
                'order_data' => $order_items,
                'tracking' => $tracking,
            ]);
            return response()->json(array(
                'data' => $order,
                'errors' => null,
            ), 201);
        } catch (\Exception $e) {

            $code = $e->getCode();
            return response()->json(array(
                'data' => false,
                'error' => $code == 23000 ? 'Cannot use email/username. Try another' : $e->getMessage(),

            ), $code == 23000 ? 409 : 500);
        }
    }
}
