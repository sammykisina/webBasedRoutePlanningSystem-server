<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model {
    use HasFactory;

    protected $fillable = [
        'path',
        'user_id'
    ];
}
