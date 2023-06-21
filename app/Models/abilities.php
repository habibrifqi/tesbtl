<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abilities extends Model
{
    use HasFactory;

    protected $table = 'abilities';
    protected $fillable = [
        'name',
        'pokemon_id',
    ];
}
