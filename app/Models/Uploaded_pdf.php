<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploaded_pdf extends Model
{
    use HasFactory;
    protected $fillable = [
        "file_path",
        "medical_record_id",
    ];
}