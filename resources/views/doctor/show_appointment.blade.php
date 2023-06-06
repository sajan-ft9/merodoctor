@extends('doctor.layout')


@section('content')
<section class="doctor_section layout_padding my-4 mx-2">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Pending Appointments
            </h2>
        </div>
        @if (count($appointments))
            
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Approval</th>
                    <th>Status</th>
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
                    <td>
                        <form action="{{ route('doctor.toggle_approval', $item->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-danger">Not Approved</button>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-danger">Pending</button>
                    </td>
                    @else
                    <td>
                        <form action="{{ route('doctor.toggle_approval', $item->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success">Approved</button>
                        </form>
                    </td>
                    @if ($item->status == 0)
                    <td>
                        <form action="{{ route('doctor.toggle_status', $item->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-danger">Pending</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endif

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