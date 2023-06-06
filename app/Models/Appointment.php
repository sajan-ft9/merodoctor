<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor(){
        return $this->hasOne(Doctor::class, "doctor_id", "doctor_id");
    }

    public function patient(){
        return $this->hasOne(Patient::class, "patient_id", "patient_id");
    }

}
