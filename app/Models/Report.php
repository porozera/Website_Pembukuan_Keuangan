<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Report extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'reports';
    public $timestamps = true;
    protected $fillable = [
        'total_sales',
        'total_hpp',
        'total_debt',
        'total_receivables',
        'net_profit',
        'report_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
