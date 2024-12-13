<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Receivable extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'receivables';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'invoice',
        'amount',
        'paid_amount',
        'rest_amount',
        'interest_rate',
        'date',
        'due_date',
        'status',
        'description'
        
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
