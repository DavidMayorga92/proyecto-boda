<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
    'name',
    'group',
    'companions',
    'status',
    'notes',
    'side',
    'child_companions',
    'adult_companions',
    ];

}
