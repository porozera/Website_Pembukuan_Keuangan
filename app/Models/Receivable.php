<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Receivable extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // Specify the table associated with this model
    protected $table = 'receivables';

    // Enable timestamps (created_at and updated_at)
    public $timestamps = true;

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'amount',          // Total receivable amount
        'interest_rate',   // Interest rate applied (optional)
        'due_date',        // Due date for the receivable
        'status',          // Payment status (e.g., 'Lunas' or 'Belum Lunas')
        'description',     // Additional description or notes (optional)
        'user_id'          // Foreign key linking to the users table
    ];

    /**
     * Define the relationship with the User model.
     * A receivable belongs to a single user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}