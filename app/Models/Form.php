<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'agent_code',
        'client_name',
        'address_name',
        'contact',
        'payment_term',
        'payment_type',
        'discount_deals',
        'tie_up_pharmacy',
        'rebates_given',
        'clinic_date',
        'deliver_date',
        'contact_person',
        'sketch_map',
        'prepared_by',
        'prepared_signature',
        'status' // New fields added
    ];
}
