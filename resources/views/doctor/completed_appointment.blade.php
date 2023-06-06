@extends('doctor.layout')


@section('content')
<section class="doctor_section layout_padding my-4 mx-2">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Completed Appointments
            </h2>
        </div>
        @if (count($appointments))
            
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Patient</th>
                    <th>Phone</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $item)

                <tr>
                    <td>{{ $item->date_bs }}</td>
                    <td>{{ $item->time_slot }}</td>
                    <td>{{ $item->patient->user->name }}</td>
                    <td>{{ $item->patient->phone }}</td>
                    <td>{{ $item->problem_desc }}</td>

                    @if ($item->status == 1)
                    <td>
                        <button class="btn btn-success">&#10004; </button>
                    </td>
                    @endif
                </tr>
                @endforeach

            </tbody>
        </table>
        @else
        <div class="alert alert-danger" role="alert">
           Nothing to show here
          </div>
        @endif
    </div>
</section>
@endsection