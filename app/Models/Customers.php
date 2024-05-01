<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'customer_name','contact_name','email_id','amc_frequency',
        'mobile_number','address','certification_standard_id','status'
    ];
}
