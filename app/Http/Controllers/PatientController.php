<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointment_count = Appointment::where("patient_id", auth()->user()->id)->count();
        return view('patient.index', compact('appointment_count'));
    }

    public function appointment()
    {
        $doctors = Doctor::with("user")->where('is_verified', 1)->get();
        return view('patient.appointment', compact('doctors'));
    }

    public function showAppointment()
    {
        $appointments = Appointment::where("patient_id", auth()->user()->id)->get();
        
        return view('patient.show_appointment', compact('appointments'));
    }



    public function makeAppointment(Request $request)
    {
        $fields = $request->validate([
            'date_bs' => "required|string",
            'date_ad' => "required|string",
            'doctor_id' => "required|numeric|exists:doctors,doctor_id",
            "time_slot" => "required|string",
            "problem_desc" => "required|string",
        ]);
        $doctor = User::find($request->doctor_id);
        $fields['patient_id'] = auth()->user()->id;
        $fields['doctor_name'] = $doctor->name;
        Appointment::create($fields);
        return redirect(route("patient.show_appointment"))->with('success', "Appointment scheduled");
    }


    public function editAppointment(Appointment $appoint)
    {
        $doctors = Doctor::with("user")->where('is_verified', 1)->get();

        return view('patient.edit_appointment',compact('appoint', 'doctors'));
    }

    public function updateAppointment(Request $request, Appointment $appoint)
    {
        $fields = $request->validate([
            'date_bs' => "required|string",
            'date_ad' => "required|string",
            'doctor_id' => "required|numeric|exists:doctors,doctor_id",
            "time_slot" => "required|string",
            "problem_desc" => "required|string",
        ]);
        $appoint->update($fields);
        return redirect(route('patient.show_appointment'))->with('success', 'Appointment updated');
    }

    
    public function deleteAppointment(Appointment $appoint)
    {
        $appoint->delete();        
        return redirect()->back()->with('success', "Appointment deleted");
    }

    public function allDoctors(Request $request){
        $doctors = Doctor::with('user')
        ->where('is_verified', 1)
        ->where(function ($query) use ($request) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->search.'%');
            })
            ->orWhere('department', 'LIKE', '%'.$request->search.'%');
        })
        ->get();
    
    
        return view('patient.doctors', compact('doctors'));
    }

    public function doctorDetails(Doctor $doctor){
        return view('patient.doctor_details',compact('doctor'));
    }

    public function profile(){
        $user = Patient::with('user')->where('patient_id', auth()->user()->id)->first();

        return view('patient.profile', compact('user'));
    }

    public function update(Request $request, Patient $patient)
    {
    $request->validate([
        'email'  => ["required","email", 'unique:users,email,'.$patient->patient_id], 
        'address'  => "required|string|max:100",
        'phone'  => "required|numeric|min:9000000000|max:9999999999",
        'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
    ]);

        $patient_fields = $request->only(['address', 'phone', 'image_path']);

      
        if ($request->image_path) {

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('patients', $imageName, 'public');
            $patient_fields['image_path'] = '/storage/patients/' . $imageName;

            $trimmedPath = trim(str_replace("/storage/", "", $patient->image_path));

            if (Storage::disk('public')->exists($trimmedPath)) {

                Storage::disk('public')->delete($trimmedPath);
            }
        }

        $user_patient = User::find($patient->patient_id);

        $user_patient->update([
            'email'=> $request->email,
        ]);

        $patient->update($patient_fields);

        return redirect(route("patient.profile"))->with('success', "Profile updated successfully");   
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
