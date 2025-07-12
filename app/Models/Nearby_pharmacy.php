<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nearby_pharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "pharmacist_name",
        "phone",
        "location",
        "working_hours",
    ];
}