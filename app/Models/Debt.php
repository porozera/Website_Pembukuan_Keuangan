<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Debt extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'debts';
    public $timestamps = true;
    protected $fillable = [
        'amount',
        'interest_rate',
        'due_date',
        'status',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
