<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sku',
        'frame_number',
        'short_name',
        'description',
        'model',
        'color',
        'size',
        'marin_code',
        'barcode_color',
        'type',
    ];

}
