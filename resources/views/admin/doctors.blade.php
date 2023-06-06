@extends('admin.layout')


@section('content')
<section class="doctor_section layout_padding my-4 mx-2">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our Doctors
            </h2>
        </div>

        <div class="row">
            @foreach ($doctors as $doctor)

            <div class="col-md-12 col-xl-4 mb-4">

                <div class="card" style="border-radius: 15px;">
                    <div class="card-body text-center">
                        <div class="mt-3 mb-4">
                            <img src="{{ asset($doctor->image_path === "" ? "/images/client.jpg" : $doctor->image_path) }}"
                                class="rounded-circle img-fluid" style="width: 150px; height:150px;object-fit:cover" />
                        </div>
                        <h4 class="mb-2">{{ $doctor->user->name }}</h4>
                        <span class="text-muted mb-4">Department<span class="mx-2">|</span> <span>{{
                                $doctor->department }}</span></span>
                        <p class="text-muted mb-4">License<span class="mx-2">|</span> <span>{{
                                $doctor->license_no }}</span></p>
                        {{-- <button type="button" class="btn btn-primary btn-rounded btn-lg">
                            Message now
                        </button> --}}

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection