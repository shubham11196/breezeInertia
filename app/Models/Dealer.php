<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'ship_to_party',
        'bill_to_party',
        'address',
        'city',
        'state',
        'zipcode',
        'phone',
        'email',
        'gst_details'
    ];
}
