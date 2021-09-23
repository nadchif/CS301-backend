<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {

        $orders = Food::get();
        return response()->json(array(
            'data' => $orders,
            'error' => null,
        ), 200);
    }
    public function get($id)
    {
        $orders = Food::where('id', $id)
            ->get();
        return response()->json(array(
            'data' => $orders,
            'error' => null,
        ), 200);
    }
}
