<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Debts_Receivables extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'debts_receivables';
    public $timestamps = true;
    protected $fillable = [
        'type',
        'invoice',
        'amount',
        'paid_amount',
        'rest_amount',
        'interest_rate',
        'date',
        'due_date',
        'status',
        'description',
        'transaction_id',
        'user_id',
        'contact'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
