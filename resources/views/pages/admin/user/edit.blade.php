@extends('layouts.admin')

@section('title')
    Ubah Pengguna
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                Ubah Pengguna
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('user.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali ke Semua Pengguna
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">Informasi Akun</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('admin/assets/img/illustrations/add_user.jpg') }}" alt=""
                                    height="470px" width="500px">
                                </div>
                                <div class="col-md-6 mt-5">
                                    <form action="{{ route('user.update', $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="name">Nama</label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                    type="text" value="{{ $item->name }}" required />
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                    type="email" value="{{ $item->email }}" required />
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror" name="password"
                                                    type="password" id="password" />
                                                <input type="checkbox" onclick="myFunction()" class="mt-2"> <label
                                                    class="small mb-1" for="checkbox">Show Password</label>
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
                                                <small class="form-text text-muted d-flex">Kosongkan jika tidak ingin mengganti
                                                    password</small>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="d-grid mt-5">
                                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
