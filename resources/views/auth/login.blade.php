@extends('layouts.auth')

@section('main')
    <main>
        <div class="container-xl px-4">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0      rounded-lg mt-5">
                        <div class="card-header justify-content-center ">
                            <h3 class="fw-light my-3-center">
                                <center>
                                    <img src="{{ asset('/admin/assets/img/illustrations/logo_kksp_surat.png') }}"
                                        width="50">&nbsp;KKSP E-SURAT
                            </h3>
                            </center>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="/login" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" type="email" value="{{ old('email') }}"
                                        placeholder="Enter email address" autofocus required />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Enter password" required />
                                    <input type="checkbox" onclick="myFunction()" class="mt-2"> <label class="small mb-1" for="checkbox">Show Password</label>
                                    <script>
                                        function myFunction() {
                                            var x = document.getElementById("password");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-success btn-login btn-secondary">Login</button>
                                </div>
                                {{-- <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>  --}}
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
