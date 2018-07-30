<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'user_id',
        'transID',
        'trans_type',
        'balance_before',
        'amount',
        'balance_after',
        'charge',
        'officer_id',
        'description',
    ];
}
