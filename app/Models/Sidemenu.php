<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidemenu extends Model
{
    use HasFactory;

    protected $table = 'side_menu';

    protected $fillable = [
        'user_id','services','certifications',
        'customers','teams','work_items','status'
    ];
}
