<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){
        $doctors = Doctor::where('is_verified', 1)->take(3)->get();
        return view('index', compact('doctors'));
    }

    public function doctors(){
        $doctors = Doctor::get();
        return view('doctors', compact('doctors'));
    }
}
