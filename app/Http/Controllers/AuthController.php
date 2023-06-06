<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PatientRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function showDoctorRegister()
    {
        return view('auth.doctor_register');
    }

    public function showPatientRegister()
    {
        return view('Auth.patient_register');
    }

    public function patientRegister(PatientRequest $request){
        
        if(isset($request->image_path)){
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('patients', $imageName, 'public');
            $image_path = '/storage/patients/' . $imageName;    
        }else{
            $image_path = "";
        };

        $patient = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3
        ]);

        Patient::create([
            'patient_id' => $patient->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'image_path' => $image_path
        ]);

        return redirect(route("loginForm"))->with('success', "Account registered successfully");

    }
    public function doctorRegister(DoctorRequest $request){
        
        if(isset($request->image_path)){
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('doctors', $imageName, 'public');
            $image_path = '/storage/doctors/' . $imageName;    
        }else{
            $image_path = "";
        };

        $password = Str::random(8);

        $doctor = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role_id' => 2
        ]);

        Doctor::create([
            'doctor_id' => $doctor->id,
            'department' => $request->department,
            'license_no' => $request->license_no,
            'image_path' => $image_path
        ]);

      

        Mail::to('harsukh21@gmail.org')->send(new \App\Mail\NewMail($password));


        return redirect(route("loginForm"))->with('success', "Account registered successfully");

    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => "required|email",
            'password' => "required|min:8",
        ]);

        $formFields = $request->only('email', 'password');

        $doctor = User::with('doctors')->where('email', $request->email)->first();

        if ($doctor->role_id == 2) {
            if ($doctor->doctors->is_verified == 1) {

                if (Auth::attempt($formFields)) {
                    if (Auth::user()->role_id == 2) {
                        $request->session()->regenerate();
                        return redirect(route('doctor.dashboard'));
                    }
                } else {
                    return back()->withErrors([
                        'email' => 'Credentials do not match our records'
                    ]);
                }
            } else {
                return redirect()->back()->withErrors(["account" => "Your account is not approved yet!"]);
            }
        }

        if (Auth::attempt($formFields)) {
            if (Auth::user()->role_id == 1) {

                $request->session()->regenerate();
                return redirect(route('admin.dashboard'));
            } elseif (Auth::user()->role_id == 3) {

                $request->session()->regenerate();

                return redirect(route('patient.all_doctors'));
            } else {
                throw new BadRequestException();
            }
        } else {
            return back()->withErrors([
                'email' => 'Credentials do not match our records'
            ]);
        }
    }


    public function logout()
    {
        Auth::logout();
        return  redirect('/');
    }
}
