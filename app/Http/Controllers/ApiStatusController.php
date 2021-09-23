<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class ApiStatusController extends Controller
{
    public function status(Request $request)
    {
        // check woocommerce
        $routeCollection = collect(Route::getRoutes())->map(function ($route) {
            return [
                'methods' => $route->methods(),
                'uri'    => $route->uri(),
            ];
        })->toArray();

        $routes = [];
        foreach ($routeCollection as $route) {
            $method = '';
            if (in_array('GET', $route['methods'])) {
                $method = 'GET';
            } elseif (in_array('POST', $route['methods'])) {
                $method = 'POST';
            } elseif (in_array('PUT', $route['methods'])) {
                $method = 'PUT';
            } elseif (in_array('DELETE', $route['methods'])) {
                $method = 'DELETE';
            } elseif (in_array('PATCH', $route['methods'])) {
                $method = 'PATCH';
            }
            if (stripos($route['uri'], 'api/') !== false) {
                $path = str_ireplace('api/', '', $route['uri']);
                $routes['endpoints'][$method][$path] = ['_links' => [
                    'self' =>
                    url()->current() . '/' . $path
                ]];
            }
        }

        return response()->json(array(
            'status' => 'API is running!',
            'version' => '1.0.0',
            'time' => date('Y-m-d H:i:s'),
            "routes" => $routes,
            "_links" => [
                "self" => [
                    "href" => url()->current()
                ]
            ]
        ), 200);
    }

    public function fallback(Request $request)
    {
        return response()->json([
            'message' => 'Path not found. If error persists, contact the administrator'
        ], 404);
    }
}
