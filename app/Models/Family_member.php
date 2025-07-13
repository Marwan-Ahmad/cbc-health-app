<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family_member extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "full_name",
        "date_of_birth",
        "gender",
        "relation",
        "photo",
    ];

    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->date_of_birth)->age;
    }

    public function user()
    {
        return $this->belongsTo("App/Models/User", "user_id");
    }

    public function medical_records()
    {
        return $this->hasMany("App/Models/Medical_record", "family_member_id");
    }
}
