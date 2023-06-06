<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class,'id', 'patient_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id');
    }
    
}
