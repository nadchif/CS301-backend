<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Food::create(
            [
                'name' => 'Chilli Burger',
                "price" => '254',
                'photo_url' => 'https://images.pexels.com/photos/1633578/pexels-photo-1633578.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );
        // 2
        Food::create(
            [
                'name' => 'French Fries',
                "price" => '108',
                'photo_url' => 'https://images.pexels.com/photos/115740/pexels-photo-115740.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );

        // 3
        Food::create(
            [
                'name' => 'Chocolate Cake (Slice)',
                "price" => '79',
                'photo_url' => 'https://images.pexels.com/photos/1854652/pexels-photo-1854652.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        );

        //4
        Food::create(
            [
                'name' => 'Vegan Sandwitch',
                "price" => '90',
                'photo_url' => 'https://images.pexels.com/photos/1351238/pexels-photo-1351238.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        );


        //5
        Food::create(
            [
                'name' => 'Strawberry Cupcake',
                "price" => '128',
                'photo_url' => 'https://images.pexels.com/photos/853006/pexels-photo-853006.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        );


        //6
        Food::create(
            [
                'name' => 'Pan Pizza',
                "price" => '315',
                'photo_url' => 'https://images.pexels.com/photos/1260968/pexels-photo-1260968.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        );

        //7
        Food::create(
            [
                'name' => 'Berry Delicious Pancake',
                "price" => '315',
                'photo_url' => 'https://images.pexels.com/photos/2280545/pexels-photo-2280545.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ]
        );

        //8
        Food::create(
            [
                'name' => 'Burritto',
                "price" => '115',
                'photo_url' => 'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'
            ]
        );


        // 9
        Food::create(
            [
                'name' => 'Milkshake',
                "price" => '99',
                'photo_url' => 'https://images.pexels.com/photos/5946663/pexels-photo-5946663.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );

        // 10
        Food::create(
            [
                'name' => 'Ice Tea',
                "price" => '45',
                'photo_url' => 'https://images.pexels.com/photos/1194030/pexels-photo-1194030.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'
            ]
        );
    }
}
