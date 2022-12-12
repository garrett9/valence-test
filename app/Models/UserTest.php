<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTest extends Pivot
{
    use HasFactory;

    public $casts = [
        'results' => 'json',
        'answers' => 'json',
    ];
}
