<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $appointment_count = Appointment::where("doctor_id", auth()->user()->id)
        ->where('status', 0)->count();
        $completed_count = Appointment::where("doctor_id", auth()->user()->id)
        ->where('status', 1)->count();
        return view('doctor.index', compact('appointment_count', 'completed_count'));
    }

    public function toggleApproval(Appointment $appointment){
        $appointment->approved = !$appointment->approved;
        $appointment->save();
        return redirect()->back()->with("success", "Approval status updated successfully");    
    }

    public function toggleStatus(Appointment $appointment){
        $appointment->status = !$appointment->status;
        $appointment->save();
        return redirect()->back()->with("success", "Approval status updated successfully");    
    }


    public function showAppointment()
    {
        $appointments = Appointment::where("doctor_id", auth()->user()->id)
            ->where('status', 0)->get();

            return view('doctor.show_appointment', compact('appointments'));
    }

    public function completedAppointment()
    {
        $appointments = Appointment::where("doctor_id", auth()->user()->id)
            ->where('status', 1)->get();
        return view('doctor.completed_appointment', compact('appointments'));
    }


    public function profile(){
        $user = Doctor::with('user')->where('doctor_id', auth()->user()->id)->first();

        return view('doctor.profile', compact('user'));
    }


    public function update(Request $request, Doctor $doctor)
    {
    $request->validate([
        'email'  => ["required","email", 'unique:users,email,'.$doctor->doctor_id], 
        'department'  => "required|string|max:50",
        'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
    ]);

        $doctor_fields = $request->only(['department', 'image_path']);

      
        if ($request->image_path) {

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('doctors', $imageName, 'public');
            $doctor_fields['image_path'] = '/storage/doctors/' . $imageName;

            $trimmedPath = trim(str_replace("/storage/", "", $doctor->image_path));

            if (Storage::disk('public')->exists($trimmedPath)) {

                Storage::disk('public')->delete($trimmedPath);
            }
        }

        $user_doctor = User::find($doctor->doctor_id);

        $user_doctor->update([
            'email'=> $request->email,
        ]);

        $doctor->update($doctor_fields);

        return redirect(route("doctor.profile"))->with('success', "Profile updated successfully");   
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


}
