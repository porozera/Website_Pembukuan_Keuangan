<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['nama', 'role', 'username', 'password', 'gaji'];
    protected $table = 'karyawan'; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
