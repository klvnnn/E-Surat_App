@extends('layouts.admin')

@section('title')
    Ubah Surat
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
                                Ubah Surat
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
            @if ($item->letter_type == 'Surat Masuk')
                <form action="{{ route('letterin.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gx-4">
                        <div class="col-lg-9">
                            <div class="card mb-4">
                                <div class="card-header">Form Surat - {{ $item->letter_no }}
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="letter_type" class="col-sm-3 col-form-label">Tipe Surat</label>
                                        <div class="col-sm-9">
                                            <select name="letter_type" class="form-control" required>
                                                <option selected disabled>Pilih..</option>
                                                <option value="Surat Masuk"
                                                    {{ $item->letter_type == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk
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
                                        <label for="letter_no" class="col-sm-3 col-form-label">No. Lampiran</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control  @error('letter_no') is-invalid @enderror"
                                                value="{{ $item->letter_no }}" name="letter_no"
                                                placeholder="Nomor Lampiran.." required>
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
                                            <input type="date" class="form-control"
                                                value="{{ $item->letter_date->format('Y-m-d') }}" name="letter_date">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('regarding') is-invalid @enderror"
                                                value="{{ $item->regarding }}" name="regarding" placeholder="Perihal.."
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
                                            <input type="text"
                                                class="form-control @error('department') is-invalid @enderror"
                                                value="{{ $item->department }}" name="department"
                                                placeholder="Tujuan Surat .." required>
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
                                            <select name="pertalian"
                                                class="form-control @error('pertalian') is-invalid @enderror selectx">
                                                <option value="{{ $item->pertalian }}"
                                                    {{ $item->pertalian ? 'selected disabled' : '' }}>
                                                    {{ $item->pertalian }}
                                                </option>
                                                @foreach ($items as $letter)
                                                    <option
                                                        value="{{ $letter->letter_no . '/' . $letter->letter_date->format('m.Y') . ' ' . '-' . ' ' . $letter->regarding }}">
                                                        {{ $letter->letter_no . '/' . $letter->letter_date->format('m.Y') . ' ' . '-' . ' ' . $letter->regarding }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="forward" class="col-sm-3 col-form-label">Ditujukan Kepada</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('forward') is-invalid @enderror"
                                                value="{{ $item->forward }}" name="forward"
                                                placeholder="Ditujukan Kepada .." required>
                                        </div>
                                        @error('forward')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_file" class="col-sm-3 col-form-label">File Surat</label>
                                        <div class="col-sm-9">
                                            <input type="file"
                                                class="form-control @error('letter_file') is-invalid @enderror"
                                                value="{{ $item->letter_file }}" name="letter_file">
                                            <div id="letter_file" class="form-text">Upload Gambar / Dokumen Lampiran</div>
                                        </div>
                                        @error('letter_file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_disposisi" class="col-sm-3 col-form-label">File
                                            Disposisi</label>
                                        <div class="col-sm-9">
                                            <input type="file"
                                                class="form-control @error('letter_disposisi') is-invalid @enderror"
                                                value="{{ $item->letter_disposisi }}" name="letter_disposisi">
                                            <div id="letter_disposisi" class="form-text">Upload Gambar / Dokumen
                                                Lampiran
                                            </div>
                                        </div>
                                        @error('letter_disposisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            </form>
            @if ($item->letter_type == 'Surat Keluar')
                <form action="{{ route('letter.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gx-4">
                        <div class="col-lg-9">
                            <div class="card mb-4">
                                <div class="card-header">Form Surat -
                                    {{ $item->letter_no . '/' . $item->letter_code . '/' . $item->letter_unit . '/' . $item->letter_date->format('m.Y') }}
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="letter_type" class="col-sm-3 col-form-label">Tipe Surat</label>
                                        <div class="col-sm-9">
                                            <select name="letter_type" class="form-control" required>
                                                <option selected disabled>Pilih..</option>
                                                <option value="Surat Keluar"
                                                    {{ $item->letter_type == 'Surat Keluar' ? 'selected' : '' }}>Surat
                                                    Keluar
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
                                        <label for="letter_no" class="col-sm-3 col-form-label">No. Lampiran</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control  @error('letter_no') is-invalid @enderror"
                                                value="{{ $item->letter_no }}" name="letter_no"
                                                placeholder="Nomor Lampiran.." required>
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
                                            <select name="letter_code" class="form-control selectx">
                                                <option value="{{ $item->letter_code }}"
                                                    {{ $item->letter_code ? 'selected disabled' : '' }}>
                                                    {{ $item->letter_code }}
                                                </option>
                                                <option value="KRE">KRE</option>
                                                <option value="PJJ">Perjanjian</option>
                                                <option value="ISP">Instruksi Pengurus</option>
                                                <option value="BA">Berita Acara</option>
                                                <option value="UND">Undangan Rapat</option>
                                                <option value="KET">Surat Keterangan</option>
                                                <option value="PUM">Surat Pengumuman</option>
                                                <option value="NTR">NOTULEN RAPAT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_no" class="col-sm-3 col-form-label">Unit Kerja</label>
                                        <div class="col-sm-9">
                                            <select name="letter_unit" class="form-control selectx">
                                                <option value="{{ $item->letter_unit }}"
                                                    {{ $item->letter_unit ? 'selected disabled' : '' }}>
                                                    {{ $item->letter_unit }}
                                                </option>
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
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control"
                                                value="{{ $item->letter_date->format('Y-m-d') }}" name="letter_date">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('regarding') is-invalid @enderror"
                                                value="{{ $item->regarding }}" name="regarding" placeholder="Perihal.."
                                                required>
                                        </div>
                                        @error('regarding')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="department_id" class="col-sm-3 col-form-label">Tujuan
                                            Surat</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('department') is-invalid @enderror"
                                                value="{{ $item->department }}" name="department"
                                                placeholder="Tujuan Surat .." required>
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
                                            <select name="pertalian"
                                                class="form-control @error('pertalian') is-invalid @enderror selectx">
                                                <option value="{{ $item->pertalian }}"
                                                    {{ $item->pertalian ? 'selected disabled' : '' }}>
                                                    {{ $item->pertalian }}
                                                </option>
                                                @foreach ($items as $letter)
                                                    <option
                                                        value="{{ $letter->letter_no . '/' . $letter->letter_code . '/' . $letter->letter_unit . '/' . 'KKSP' . '/' . $letter->letter_date->format('m.Y') . ' ' . '-' . ' ' . $letter->regarding }}">
                                                        {{ $letter->letter_no . '/' . $letter->letter_code . '/' . $letter->letter_unit . '/' . 'KKSP' . '/' . $letter->letter_date->format('m.Y') . ' ' . '-' . ' ' . $letter->regarding }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_file" class="col-sm-3 col-form-label">File Surat</label>
                                        <div class="col-sm-9">
                                            <input type="file"
                                                class="form-control @error('letter_file') is-invalid @enderror"
                                                value="{{ $item->letter_file }}" name="letter_file">
                                            <div id="letter_file" class="form-text">Upload Gambar / Dokumen Lampiran</div>
                                        </div>
                                        @error('letter_file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
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
