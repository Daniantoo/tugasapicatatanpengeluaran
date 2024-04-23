<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'description', 'amount', 'date']; // Kolom yang dapat diisi secara massal

    // Definisikan relasi dengan model User jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}