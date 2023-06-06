@extends('public_layout.layout')

@section('content')
<div class="container">
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden rounded my-4">
        <style>
            body {
                background: #E8ECF3;
            }

            .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(170, 41%, 35%) 15%,
                        hsl(182, 41%, 30%) 35%,
                        hsl(171, 41%, 20%) 75%,
                        hsl(151, 40%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(108, 41%, 45%) 15%,
                        hsl(143, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.45) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }
        </style>
        <div class="container px-4 py-5 px-md-5 text-lg-start my-5 ">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        मेरो डाक्टर <br />
                        <span style="color: hsl(218, 81%, 75%)">मेरो समस्यामा साथी</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        "आफूलाई रक्षा, सेवाको निश्चय। स्वास्थ्य आधार, हाम्रो अभियान।"
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <h2>Login</h2>
                            @if($errors->has('account'))
                            <small class="text-danger">{{ $errors->first('account') }}</small>
                            @enderror
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-outline mt-4">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="email" name="email" value="{{ old('email') }}" id="form3Example3" class="form-control @error('email')
                                        {{ "border-danger" }} @enderror" required />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                </div>
                                <div class="form-outline mt-2 mb-4">

                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="password" name="password" id="form3Example1" class="form-control @error('password') {{ "border-danger" }} @enderror"
                                         required />
                                    <label class="form-label" for="form3Example1">Password</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Sign in
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p><a href="{{ route('patient.registerForm') }}">Patient Registration</a></p>
                                    <p><a href="{{ route('doctor.registerForm') }}">Doctor Registration </a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</div>
@endsection