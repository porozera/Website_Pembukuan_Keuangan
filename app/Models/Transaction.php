<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Transaction extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'transactions';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'date',
        'transaction_type',
        'debit',
        'credit',
        'amount',
        'description',
        'contact',
        'tax',
        'due_date',
        'interest_rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function debitAccount()
    {
        return $this->belongsTo(Account::class, 'debit', 'code');
    }

    public function creditAccount()
    {
        return $this->belongsTo(Account::class, 'credit', 'code');
    }
}
