@extends('public_layout.layout')

@section('content')
<link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
  rel="stylesheet" type="text/css" />
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
  type="text/javascript"></script>

<section class="n layout_padding">
    <div class="container">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body text-center">
                            <img src="{{ asset($doctor->image_path == "" ? '/images/client.jpg' : $doctor->image_path)
                            }}"
                            alt="avatar" class="img-fluid">
                            <h5 class="my-3">{{ $doctor->user->name }}</h5>
                            <p class=" mb-1">{{ $doctor->user->email }}</p>
                            <p class=" mb-4">{{ $doctor->department }}</p>
                            <p class=" mb-4">License - {{ $doctor->license_no }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">

                    <form class="text-white" action="{{ route('patient.make_appointment') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <h2>Appointment request</h2>
                            <div class=" form-group">
                                <label for="">Date</label>
                                <input type="text" name="date_bs" id="nepali-datepicker" readonly class="form-control"
                                    placeholder="Date in BS" required>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col form-group mb-2">
                                <label for="">Doctor</label>
                                <select class="form-control" name="doctor_id" @selected(old('doctor_id')) required>
                                    <option value="{{ $doctor->doctor_id }}">{{ $doctor->user->name }} - {{
                                        $doctor->department }}</option>
                                </select>
                            </div>
                            <div class="col form-group mb-2">
                                <label for="">Time Slot</label>
                                <select class="form-control" name="time_slot" @selected(old('time_slot')) required>
                                    <option value="M">Morning (7AM-9AM)</option>
                                    <option value="D">Day (10AM-1PM)</option>
                                    <option value="E">Evening (3PM-6PM)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col form-group mb-2" style="margin-left: -12px">
                            <label for="">Problem Description</label>
                            <textarea name="problem_desc" class="form-control" id="" cols="30"
                                rows="10">{{ old("problem_desc") }}</textarea>
                        </div>
                        <div class="col-sm-3">

                            <button type="submit" class="btn  btn-primary w-100 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
  window.onload = function() {
  var mainInput = document.getElementById("nepali-datepicker");
  mainInput.nepaliDatePicker();
console.log(NepaliFunctions.AD2BS({year: 2023, month: 6, day: 15}));
};
</script>
@endsection