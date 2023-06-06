@extends('doctor.layout')

@section('content')
<section class="doctor_section layout_padding m-4">
    <div class="container">
        <div class="heading_container heading_center">
            <div class="row">
                <div class="col-lg-3 mb-2">
                    <div class="bg-danger text-center text-white py-2 px-4 rounded">
                        <a class="text-decoration-none text-white" href="{{ route("doctor.show_appointment") }}">
                            <h3>Pending Appointments</h3>
                            <h4>{{ $appointment_count }}</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="bg-success text-center text-white py-2 px-4 rounded">
                        <a class="text-decoration-none text-white" href="{{ route("doctor.completed_appointment") }}">
                            <h3>Completed Appointments</h3>
                            <h4>{{ $completed_count }}</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection