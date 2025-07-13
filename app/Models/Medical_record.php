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

    public function user()
    {
        return $this->belongsTo("App/Models/User", "user_id");
    }

    public function family_member()
    {
        return $this->belongsTo("App/Models/Family_member", "family_member_id");
    }

    public function uploaded_pdf()
    {
        return $this->hasOne("App/Models/Uploaded_pdf", "medical_record_id");
    }
}
