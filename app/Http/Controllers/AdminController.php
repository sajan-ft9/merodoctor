<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $verified_doc = Doctor::where('is_verified', 1)->count();
        $approval_req = Doctor::where('is_verified', 0)->count();
        $patients_count = Patient::count();
        $appointment_count = Appointment::count();
        return view('admin.index', compact('verified_doc', 'approval_req', 'patients_count', 'appointment_count'));
    }

    public function allDoctors()
    {
        $doctors = Doctor::with("user")->where('is_verified', 1)->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('admin.profile', compact('user'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'email'  => ["required", "email", 'unique:users,email,' . $admin->id],
            'name'  => "required|string|max:50",
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'hospital.png'; // New image name
            $image->move(public_path('images'), $imageName);
        }
     

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect(route("admin.profile"))->with('success', "Profile updated successfully");
    }

     
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>["required"],
            'password'=>['required','min:8','confirmed'],
        ]);
        $user = auth()->user();
        $oldPassword = $request->old_password;

        if (Hash::check($oldPassword, $user->password)) {
            $user = User::find(auth()->user()->id);
            $user->update(['password'=>Hash::make($request->password)]);
            return redirect()->back()->with("success", "Password updated successfully");    
        } else {
            return redirect()->back()->withErrors(["old_password" => "Old password is not correct !"]);
        }
        
    }

    public function approvalRequests(){
        $doctors = Doctor::with("user")->get();
        return view('admin.approval_requests', compact('doctors'));
    }
    public function toggleApproval(Doctor $doctor){
        $doctor->is_verified = !$doctor->is_verified;
        $doctor->save();
        return redirect()->back()->with("success", "Approval status updated successfully");    
    }

}
