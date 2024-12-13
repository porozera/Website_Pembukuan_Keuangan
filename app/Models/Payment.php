<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Payment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = [
        'debts_receivables_id',
        'code',
        'date',
        'paid_amount',
        'account',
        'description'
    ];

    public function debt_receivable()
    {
        return $this->belongsTo(Debts_Receivables::class);
    }
}
