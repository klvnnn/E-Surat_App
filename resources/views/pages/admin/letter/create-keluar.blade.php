@extends('layouts.admin')

@section('title')
    Tambah Surat Keluar
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
                                Tambah Surat Keluar
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
            <form action="{{ route('letter.store') }}" method="post">
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
                                            {{-- <option value="Surat Masuk"
                                                {{ old('letter_type') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk
                                            </option> --}}
                                            <option value="Surat Keluar"
                                                {{ old('letter_type') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar
                                            </option>
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
                                            value="{{ $angkaFormatted }}" name="letter_no" placeholder="Nomor Surat.."
                                            required>
                                    </div>
                                    @error('letter_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">Jenis Surat</label>
                                    <div class="col-sm-9">
                                        <select name="letter_code" class="form-control selectx" required>
                                            <option selected disabled></option>
                                            <option value="KRE">KORESPONDENSI EKSTERNAL</option>
                                            <option value="PJJ">SURAT PERJANJIAN</option>
                                            <option value="ISP">INTRUKSI PENGURUS</option>
                                            <option value="BA">BERITA ACARA</option>
                                            <option value="UND">UNDANGAN RAPAT</option>
                                            <option value="KET">SURAT KETERANGAN</option>
                                            <option value="PUM">SURAT PENGUMUMAN</option>
                                            <option value="NTR">NOTULEN RAPAT</option>
                                        </select>
                                    </div>
                                    @error('letter_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">Unit Kerja</label>
                                    <div class="col-sm-9">
                                        <select name="letter_unit" class="form-control selectx" required>
                                            <option selected disabled></option>
                                            <option value="KKSP">KKSP</option>
                                            <option value="DKM">DIVISI KOMERSIL</option>
                                            <option value="DKMVU">Unit VARIA USAHA</option>
                                            <option value="DKMTO">Unit TOSERBA</option>
                                            <option value="DKMPBM">Unit PBM</option>
                                            <option value="DKMSUP">Unit SUPPLIER & KONTRAKTOR / DKMSUP</option>
                                            <option value="DKMKONT">Unit SUPPLIER & KONTRAKTOR / DKMKONT</option>
                                            <option value="DKMP">Unit PEMBELIAN</option>
                                            <option value="DKS">DIVISI KEUANGAN & SDM</option>
                                            <option value="DKSSDM">Unit SDM</option>
                                            <option value="DKSPBU">Unit SPBU</option>
                                            <option value="DKSAP">Unit AKUNTANSI & PAJAK</option>
                                            <option value="DKSKEU">Unit KEUANGAN</option>
                                            <option value="DKSSP">Unit SIMPAN PINJAM</option>
                                            <option value="DDT">DIVISI DISTRIBUSI & TRANSPORTASI</option>
                                            <option value="DDTDR">Unit DISTRIBUSI</option>
                                            <option value="DDTTR">Unit TRANSPORTASI</option>
                                            <option value="DOP">DIVISI OPERASIONAL</option>
                                            <option value="DOPUM">Unit UMUM & LEGAL</option>
                                            <option value="DOPPKT">Unit PAB.KANTONG</option>
                                            <option value="DOPGDG">Unit GUDANG</option>
                                            <option value="DOPK3">Unit SMK3</option>
                                            <option value="DPI">DIVISI SPI</option>
                                            <option value="DPIPO">Unit PENGAWAS OPERASIONAL</option>
                                            <option value="DPIKAD">Unit PENGAWAS KEU & ADM</option>
                                        </select>
                                    </div>
                                    @error('letter_unit')
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
                                    <label for="department_id" class="col-sm-3 col-form-label">Tujuan Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                            value="{{ old('department') }}" name="department" placeholder="Tujuan Surat .."
                                            required>
                                    </div>
                                    @error('department')
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
                                                <option value="{{ $items->letter_no . '/' . $items->letter_code . '/' . $items->letter_unit . '/' .'KKSP'.'/'. $items->letter_date->format('m.Y').' '.'-'.' '. $items->regarding }}">{{ $items->letter_no . '/' . $items->letter_code . '/' . $items->letter_unit . '/' .'KKSP'.'/'. $items->letter_date->format('m.Y').' '.'-'.' '. $items->regarding  }}</option>
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
