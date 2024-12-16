<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'accounts';
    public $timestamps = true;
    protected $fillable = [
        'code',
        'name',
        'category',
        'account_type',
        'description'
        
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function debitTransactions()
    {
        return $this->hasMany(Transaction::class, 'debit', 'code');
    }

    public function creditTransactions()
    {
        return $this->hasMany(Transaction::class, 'credit', 'code');
    }
}
