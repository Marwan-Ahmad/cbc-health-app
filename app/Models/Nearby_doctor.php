<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nearby_doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "specialty",
        "phone",
        "location",
        "photo",
    ];
}