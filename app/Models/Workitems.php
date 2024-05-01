<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workitems extends Model
{
    use HasFactory;

    protected $table = 'work_items';

    protected $fillable = [
        'work_item_name','assign_to','start_date','end_date','description','status'
    ];
}
