<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certifications extends Model
{
    use HasFactory;

    protected $table = 'certifications';

    protected $fillable = [
        'standard','certification_body','status'
    ];
}
