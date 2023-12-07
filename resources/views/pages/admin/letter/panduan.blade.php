@extends('layouts.admin')
@section('title')
    Panduan Surat
@endsection

@section('container')
    <!-- Delete Panduan Alert--->
    <div class="modal fade" id="deletePanduanModal" tabindex="-1" aria-labelledby="deletePanduanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/letter/panduan/{id}/delete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Panduan Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="deletePanduan_id" id="id">
                        <p>Apakah anda yakin ingin menghapus Panduan Surat Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak, Batalkan</button>
                        <button class="btn btn-danger" type="submit">
                            <i class="far fa-trash-alt"></i> &nbsp; Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Panduan Alert--->
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="book"></i></div>
                                Panduan Surat
                            </h1>
                            <div class="page-header-subtitle">Format Surat</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Panduan Surat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-n15">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Perjanjian</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/SURAT-PERJANJIAN.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Keterangan</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/SURAT-KETERANGAN.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Berita Acara</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/BERITA-ACARA.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Instruksi</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/INSTRUKSI-KKSP.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat KRE</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/KRE-KKSP.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Pengumuman</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/PENGUMUMAN-KKSP.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Undangan Rapat</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/UNDANGAN-RAPAT.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">Surat Notulen Rapat</div>
                        <div class="card-body">
                            <iframe src="{{ url('admin/assets/pdf/NOTULEN-RAPAT.pdf') }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div> --}}
                @foreach ($item as $items)
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        {{ $items->title }}
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <a class="btn btn-primary btn-xs me-2"
                                            href="{{ route('panduan.edit', $items->id) }}">
                                            <i class="fas fa-edit"></i> &nbsp; Ubah
                                        </a>
                                        <button class="btn btn-danger btn-xs deletePanduan" value="{{ $items->id }}">
                                            <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <iframe src="{{ asset('storage/letter-panduan/' . $items->file) }}" frameborder="0"
                                    class="mt-4 mb-4">
                                </iframe>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@push('alert-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deletePanduan', function(e) {
                e.preventDefault();
                var id = $(this).val();
                $('#id').val(id);
                $('#deletePanduanModal').modal('show');
            });
        });
    </script>
@endpush
