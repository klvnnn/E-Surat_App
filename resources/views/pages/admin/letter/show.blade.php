@extends('layouts.admin')

@section('title')
    Detail Surat
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
                                Detail Surat
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
            <div class="row gx-4">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        @if ($item->letter_type == 'Surat Masuk')
                            <div class="card-header">Detail Surat / {{ $item->letter_type }} / No. {{ $agendaMasuk }}
                            </div>
                        @endif
                        @if ($item->letter_type == 'Surat Keluar')
                            <div class="card-header">Detail Surat / {{ $item->letter_type }} / No. {{ $item->letter_no }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="mb-3 row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Jenis Surat</th>
                                            <td>{{ $item->letter_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Surat</th>
                                            @if ($item->letter_type == 'Surat Keluar')
                                                <td>{{ $item->letter_no . '/' . $item->letter_code . '/' . $item->letter_unit . '/' . 'KKSP' . '/' . $item->letter_date->format('m.Y') }}
                                                </td>
                                            @else
                                                <td>{{ $item->letter_no }}</td>
                                            @endif
                                        </tr>
                                        @if ($item->letter_type == 'Surat Keluar')
                                            <tr>
                                                <th>Kode Surat</th>
                                                @if ($item->letter_code == 'KRE')
                                                    <td>KRE</td>
                                                @endif
                                                @if ($item->letter_code == 'ISP')
                                                    <td>ISP (INSTRUKSI PENGURUS)</td>
                                                @endif
                                                @if ($item->letter_code == 'PJJ')
                                                    <td>PJJ (SURAT PERJANJIAN)</td>
                                                @endif
                                                @if ($item->letter_code == 'BA')
                                                    <td>BA (BERITA ACARA)</td>
                                                @endif
                                                @if ($item->letter_code == 'UND')
                                                    <td>UND (UNDANGAN RAPAT)</td>
                                                @endif
                                                @if ($item->letter_code == 'KET')
                                                    <td>KET (SURAT KETERANGAN)</td>
                                                @endif
                                                @if ($item->letter_code == 'PUM')
                                                    <td>PUM (SURAT PENGUMUMAN)</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>Unit Kerja</th>
                                                @if ($item->letter_unit == 'KKSP')
                                                    <td>KKSP</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKM')
                                                    <td>DIVISI KOMERSIL</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMVU')
                                                    <td>Unit VARIA USAHA</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMTO')
                                                    <td>Unit TOSERBA</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMPBM')
                                                    <td>Unit PBM</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMSUP')
                                                    <td>Unit SUPPLIER & KONTRAKTOR</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMKONT')
                                                    <td>Unit SUPPLIER & KONTRAKTOR</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKMP')
                                                    <td>Unit PEMBELIAN</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKS')
                                                    <td>DIVISI KEUANGAN & SDM</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKSSDM')
                                                    <td>Unit SDM</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKSPBU')
                                                    <td>Unit SPBU</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKSAP')
                                                    <td>Unit AKUNTANSI & PAJAK</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKSKEU')
                                                    <td>Unit KEUANGAN</td>
                                                @endif
                                                @if ($item->letter_unit == 'DKSSP')
                                                    <td>Unit SIMPAN PINJAM</td>
                                                @endif
                                                @if ($item->letter_unit == 'DDT')
                                                    <td>DIVISI DISTRIBUSI & TRANSPORTASI</td>
                                                @endif
                                                @if ($item->letter_unit == 'DDTDR')
                                                    <td>Unit DISTRIBUSI</td>
                                                @endif
                                                @if ($item->letter_unit == 'DDTTR')
                                                    <td>Unit TRANSPORTASI</td>
                                                @endif
                                                @if ($item->letter_unit == 'DOP')
                                                    <td>DIVISI OPERASIONAL</td>
                                                @endif
                                                @if ($item->letter_unit == 'DOPUM')
                                                    <td>Unit UMUM</td>
                                                @endif
                                                @if ($item->letter_unit == 'DOPPKT')
                                                    <td>Unit PAB.KANTONG & CSTB</td>
                                                @endif
                                                @if ($item->letter_unit == 'DOPGDG')
                                                    <td>Unit GUDANG</td>
                                                @endif
                                                @if ($item->letter_unit == 'DOPK3')
                                                    <td>Unit SMK3</td>
                                                @endif
                                                @if ($item->letter_unit == 'DPI')
                                                    <td>DIVISI SPI</td>
                                                @endif
                                                @if ($item->letter_unit == 'DPIPO')
                                                    <td>Unit PENGAWAS OPERASIONAL</td>
                                                @endif
                                                @if ($item->letter_unit == 'DPIKAD')
                                                    <td>Unit PENGAWAS KEU & ADM</td>
                                                @endif
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Tanggal Surat</th>
                                            <td>{{ $item->letter_date->format('d-F-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perihal</th>
                                            <td>{{ $item->regarding }}</td>
                                        </tr>
                                        @if ($item->letter_type == 'Surat Masuk')
                                            <tr>
                                                <th>Ditujukan Kepada</th>
                                                <td>{{ $item->forward }}</td>
                                            </tr>
                                        @endif
                                        @if ($item->letter_type == 'Surat Masuk')
                                            <tr>
                                                <th>Pengirim Surat</th>
                                                <td>{{ $item->department }}</td>
                                            </tr>
                                        @endif
                                        @if ($item->letter_type == 'Surat Keluar')
                                            <tr>
                                                <th>Tujuan Surat</th>
                                                <td>{{ $item->department }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Pertalian No Surat</th>
                                            <td>{{ $item->pertalian }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Lampiran File Surat</div>
                                <div class="card-body">
                                    @if ($item->letter_file > 0)
                                        <iframe src="{{ asset('storage/letter-file/' . $item->letter_file ) }}"
                                            frameborder="0" class="mt-4 mb-4">
                                        </iframe>
                                    @endif
                                    @if ($item->letter_file == 0)
                                        <div class="alert alert-warning" role="alert">
                                            File belum di inputkan !
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->letter_type == 'Surat Masuk')
                    <div class="col-lg-3">
                        <div class="card mb-4">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">Lampiran File Disposisi</div>
                                    <div class="card-body">
                                        @if ($item->letter_disposisi > 0)
                                            <iframe
                                                src="{{ asset('storage/letter-disposisi/' . $item->letter_disposisi) }}"
                                                frameborder="0" class="mt-4 mb-4">
                                            </iframe>
                                        @endif
                                        @if ($item->letter_disposisi == 0)
                                            <div class="alert alert-warning" role="alert">
                                                File belum di inputkan !
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>
@endsection
