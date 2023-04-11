<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoEntriesZone extends Model
{
    use HasFactory;

    protected $table = 'crypto_entries_zone';

    protected $fillable = ['area_d', 'area_h4', 'area_h1', 'area_m30'];

}
