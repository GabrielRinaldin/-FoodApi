<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoacaoRealizada extends Model
{
    protected $casts = [
        'retirado' => 'boolean',
        'created_at' => 'date'
    ];
    use HasFactory;
}
