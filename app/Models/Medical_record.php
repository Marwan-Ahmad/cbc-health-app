<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_record extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "family_member_id",
        "disease",
        "diagnosis",
        "model_confidence",
        "test_type",
        "qr_code",
        "analyzed_at",
    ];
}