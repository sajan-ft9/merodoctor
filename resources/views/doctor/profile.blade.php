@extends('doctor.layout')

@section('content')
<section class="doctor_section layout_padding m-4">
    <div class="container">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset($user->image_path == "" ? "/images/client.jpg" : $user->image_path) }}"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;height:150px;">
                            <h5 class="my-3">{{ $user->user->name }}</h5>
                            <p class="text-muted mb-1">{{ $user->user->email }}</p>
                            <p class="text-muted mb-4">Dept: {{ $user->department }}</p>
                            <p class="text-muted mb-4">License No- {{ $user->license_no }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">

                            <form action="{{ route("doctor.update", $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PATCH")

                                <div class="row">
                                    <h2 class="mb-4 text-danger">Update Profile</h2>

                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="email" type="email" class="text-muted form-control mb-0"
                                            value="{{ $user->user->email }}" required />
                                    </div>
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">Department</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="department" type="tel" class="text-muted form-control mb-0"
                                            value="{{ $user->department }}" required />
                                        @error('department')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">Photo</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" name="image_path" id="image" class="form-control"
                                            class="form-control @error('image_path') {{ 'border-danger' }} @enderror "
                                            accept="image/*" onchange="loadFile(event)" id="imgInp" />
                                        <img class="mt-2" id="output" alt="">
                                        @error('image_path')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">

                                    <button type="submit" class="btn  btn-primary w-100 text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">

                            <form action="{{ route("doctor.update_password") }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PATCH")

                                <div class="row">
                                    <h2 class="mb-4 text-danger">Change Password</h2>

                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">Old Password</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="old_password" type="password" class="text-muted form-control mb-0"
                                             required />
                                    </div>
                                    @error('old_password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">New Password</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="password" type="password" class="text-muted form-control mb-0"
                                            required />
                                        @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 text-end">
                                        <p class="mb-0">Confirm Password</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="password_confirmation" type="password" class="text-muted form-control mb-0"
                                            required />
                                        @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-3">

                                    <button type="submit" class="btn  btn-primary w-100 text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var loadFile = function(event) {
	  var output = document.getElementById('output');
	  output.height = "100"
	  output.width = "100"
	  output.src = URL.createObjectURL(event.target.files[0]);	
	  output.onload = function() {
		URL.revokeObjectURL(output.src) // free memory
	  }
	};
</script>
@endsection
