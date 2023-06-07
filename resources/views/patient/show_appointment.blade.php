@extends('public_layout.layout')


@section('content')
<section class="layout_padding" style="height:80vh">
    <div class="container">
        <div class="heading_container heading_center mb-2">
            <h2 class="text-white">
                Appointments
            </h2>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $item)
                    
                <tr>
                    <td>{{ $item->date_bs }}</td>
                    <td>{{ $item->time_slot }}</td>
                    <td>{{ $item->doctor_name }}</td>
                    <td>{{ $item->doctor->department }}</td>
                    <td>{{ $item->problem_desc }}</td>
                    @if ($item->approved == 0)
                        <td><div class="btn btn-warning">Pending</div></td>
                        <td>
                            <a href="{{ route('patient.edit_appointment', $item->id) }}" class="btn btn-outline-warning">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('patient.delete_appointment', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" href="" class="btn btn-danger">Delete</button>
    
                            </form>
                        </td>
                        @else
                    <td colspan="3"><span class="text-success fs-4"> &#10003;</span></td>
                    @endif
                    
                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</section>
@endsection