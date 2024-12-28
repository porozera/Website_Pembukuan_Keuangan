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
        'quantity_produced',
        'raw_material_cost',
        'labor_cost',
        'overhead_cost',
        'packaging_cost',
        'other_production_costs',
        'total_production_cost',
        'price_per_unit',
        'sales_revenue',
        'sales_return',
        'sales_discount',
        'sales_shipping_cost',
        'recommended_price',
        'hpp',
        'gross_profit',
        'product_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
