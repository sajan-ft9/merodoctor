@extends('public_layout.layout')


@section('content')
<section class=" layout_padding">
    <div class="container">
        <div class="heading_center mb-4" >
            <h2 class="text-white" style="display: inline-flex">
                Our Doctors
                
            </h2>
            <form action="{{ route('patient.all_doctors') }}" method="get" style="display: inline-flex;float:right">
                @csrf
                <input type="text" name="search" class="form-control" placeholder="search doctor" required>
            </form>
        </div>
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
        <div class="row">
            @foreach ($doctors as $doctor)

            <div class="col-md-12 col-xl-4 mb-4">

                <div class="card doctors" style="border-radius: 15px;">
                    <div class="card-body text-center">
                        <div class="mt-3 mb-4">
                            <a href="{{ route('patient.doctor_details', $doctor->id) }}">
                                <img src="{{ asset($doctor->image_path === ""? '/images/client.jpg' : $doctor->image_path)
                            }}" class="rounded-circle img-fluid" style="width: 150px; height:150px;object-fit:cover" />
                            </a>
                        </div>
                        <h4 class="mb-2">{{ $doctor->user->name }}</h4>
                        <p class="text-muted mb-4">Department<span class="mx-2">|</span> <span>{{
                                $doctor->department }}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection