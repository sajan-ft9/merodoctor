@extends('admin.layout')


@section('content')
<section class="doctor_section layout_padding my-4 mx-2">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Doctors
            </h2>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>License Number</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $key=>$doctor)
                @php
                $key++
                @endphp
                <tr>

                    <td>{{ $key }}</td>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->license_no }}</td>
                    <td>{{ $doctor->user->email }}</td>
                    <td>{{ $doctor->department }}</td>
                    @if ($doctor->is_verified == 0)
                    <td>
                        <form action="{{ route('admin.toggle_approval', $doctor->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-danger">Not Approved</button>
                        </form>
                    </td>
                    @else
                    <td>
                        <form action="{{ route('admin.toggle_approval', $doctor->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success">Approved</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</section>
@endsection