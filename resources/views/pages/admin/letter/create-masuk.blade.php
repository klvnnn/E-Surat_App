@extends('layouts.admin')

@section('title')
    Tambah Surat Masuk
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Tambah Surat Masuk
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Semua Surat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid px-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('letterin.store') }}" method="post">
                @csrf
                <div class="row gx-4">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">Form Surat</div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="letter_type" class="col-sm-3 col-form-label">Tipe Surat</label>
                                    <div class="col-sm-9">
                                        <select name="letter_type" class="form-control" required>
                                            <option value="Surat Masuk"
                                                {{ old('letter_type') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk
                                            </option>
                                            {{-- <option value="Surat Keluar"
                                                {{ old('letter_type') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar
                                            </option> --}}
                                        </select>
                                    </div>
                                    @error('letter_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">No. Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            value="{{ old('letter_no') }}" name="letter_no" placeholder="Nomor Surat.."
                                            required>
                                    </div>
                                    @error('letter_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('letter_date') is-invalid @enderror"
                                            value="{{ old('letter_date') }}" name="letter_date" required>
                                    </div>
                                    @error('letter_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('regarding') is-invalid @enderror"
                                            value="{{ old('regarding') }}" name="regarding" placeholder="Perihal.."
                                            required>
                                    </div>
                                    @error('regarding')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="department_id" class="col-sm-3 col-form-label">Pengirim Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                            value="{{ old('department') }}" name="department" placeholder="Pengirim Surat .."
                                            required>
                                    </div>
                                    @error('department')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="forward" class="col-sm-3 col-form-label">Diteruskan Kepada</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('forward') is-invalid @enderror"
                                            value="{{ old('forward') }}" name="forward" placeholder="Diteruskan Kepada .."
                                            required>
                                    </div>
                                    @error('forward')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="pertalian" class="col-sm-3 col-form-label">Pertalian Surat</label>
                                    <div class="col-sm-9">
                                        <select name="pertalian" class="form-control @error('pertalian') is-invalid @enderror selectx">
                                            <option selected disabled></option>
                                            @foreach ($item as $items)
                                                <option value="{{ $items->letter_no .'/'. $items->letter_date->format('m.Y').' '.'-'.' '. $items->regarding }}">{{ $items->letter_no . $items->letter_date->format('m.Y').' '.'-'.' '. $items->regarding  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".selectx").select2({
            theme: "bootstrap-5"
        });
    </script>
@endpush
