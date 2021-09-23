<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    public function get($id)
    {
        $currentUser = Auth::user();

        $orders = Order::where('id', $id)
            ->where('user_id', $currentUser->id)
            ->get();
        return response()->json(array(
            'data' => $orders,
            'error' => null,
        ), 200);
    }
}
