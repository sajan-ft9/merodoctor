@extends('admin.layout')

@section('content')
<section class="doctor_section layout_padding m-4">
    <div class="container">
        <div class="heading_container heading_center">
            <div class="row">
                <div class="col-lg-3 mb-2">
                    <div class="bg-success text-center text-white py-2 px-4 rounded">
                        <a class="text-decoration-none text-white" href="{{ route("admin.all_doctors") }}">
                            <h3>Verified Doctors</h3>
                            <h4>{{ $verified_doc }}</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="bg-danger text-center text-white py-2 px-4 rounded">
                        <a class="text-decoration-none text-white" href="{{ route("admin.approval_requests") }}">
                        <h3> Approval Requests</h3>
                        <h4>{{ $approval_req }}</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 mmb-2">
                    <div class="bg-warning text-center text-white py-2 px-4 rounded">
                        <h3> Registered Patients</h3>
                        <h4>{{ $patients_count }}</h4>
                    </div>
                </div>
                <div class="col-lg-3 mb-2">
                    <div class="bg-primary text-center text-white py-2 px-4 rounded">
                        <h3>Total Appointments</h3>
                        <h4>{{ $appointment_count }}</h4>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
