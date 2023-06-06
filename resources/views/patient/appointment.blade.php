@extends('public_layout.layout')

@section('content')
<link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
  rel="stylesheet" type="text/css" />
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
  type="text/javascript"></script>

 <section class="layout_padding" >
  <div class="container mb-5 p-4 rounded-lg">
    

    <div class="shadow p-4 rounded-lg">
      <h2 class="text-white">Request an Appointment</h2>
      @if ($errors->any())
      <div class="col">

        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif
      <form class="col-lg-6 text-white" action="{{ route('patient.make_appointment') }}" method="POST">
        @csrf
        <div class="row mb-2">
          <div class=" form-group">
            <label for="">Date</label>
            <input type="text" name="date_bs" id="nepali-datepicker" readonly class="form-control" placeholder="Date in BS" required>
          </div>
        </div>
        <div class="row">

          <div class="col form-group mb-2">
            <label for="">Doctor</label>
            <select class="form-control" name="doctor_id" @selected(old('doctor_id')) required>
              @foreach ($doctors as $doctor)
              <option value="{{ $doctor->doctor_id }}">{{ $doctor->user->name }} - {{ $doctor->department }}</option>
              @endforeach
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
          <textarea name="problem_desc" class="form-control" id="" cols="30" rows="10">{{ old("problem_desc") }}</textarea>
        </div>

        <button type="submit" class="btn btn-danger">Request Appointment</button>
      </form>
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