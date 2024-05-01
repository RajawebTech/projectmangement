<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amcfrequency extends Model
{
    use HasFactory;

    protected $table = 'amc_frequency';

    protected $fillable = [
        'name','status'
    ];
}
