<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_data',
        'user_id',
        'tracking'
    ];

    protected $attributes = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    protected $casts = [
        'order_data' => 'array',
    ];

    public function getEstimatedDelivery()
    {
        return Carbon::parse($this->created_at)->addMinutes(45);
    }
}
