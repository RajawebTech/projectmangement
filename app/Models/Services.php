<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'customer_name', 
        'types_of_services',
        'service_status',
        'amc_frequency',
        'due_date',
        'planned_auditor',
        'work_items',
        'work_logs',
        'status'
    ];
}
