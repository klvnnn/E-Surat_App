@extends('layouts.admin')

@section('title')
    Tambah Panduan Surat
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
                                Tambah Panduan Surat
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('panduan') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali ke Semua Panduan
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
                        <div class="card-header">Tambah Panduan</div>
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
                            <form action="{{ route('panduan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="title">Nama Panduan</label>
                                        <input class="form-control @error('title') is-invalid @enderror" name="title"
                                            type="text" value="{{ old('title') }}" required autofocus placeholder="Contoh: Surat Ketenagakerjaan" />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="file" class="col-sm-3 col-form-label">File Surat</label>
                                    <div class="col-sm-12">
                                        <input type="file"
                                            class="form-control @error('file') is-invalid @enderror"
                                            value="{{ old('file') }}" name="file">
                                        <div id="file" class="form-text">Upload File :pdf</div>
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <center>
                                    <button class="btn btn-primary" type="submit">
                                        Tambah Panduan Baru
                                    </button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
