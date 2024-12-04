<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Hppcalculation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'hppcalculations';
    public $timestamps = true;
    protected $fillable = [
        'initial_stock',
        'final_stock',
        'purchase_amount',
        'shipping_cost',
        'purchase_return',
        'recommended_price',
        'purchase_discount',
        'sales_revenue',
        'sales_return',
        'sales_discount',
        'sales_shipping_cost',
        'hpp',
        'gross_profit',
        'product_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
