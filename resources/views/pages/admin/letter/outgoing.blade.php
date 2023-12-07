@extends('layouts.admin')

@section('title')
    Surat Keluar
@endsection

@section('container')
    <!-- Reset Alert !!! -->
    <div class="modal fade" id="resetOutModal" tabindex="-1" aria-labelledby="resetOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Data Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus semua data Surat? Semua data yang telah di masukkan
                        akan menghilang!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Batalkan</button>
                    <a class="btn btn-danger me-3" href="{{ route('reset-letter-out') }}">
                        <i data-feather="trash-2"></i> &nbsp;
                        Reset All Data
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Alert Model -->
    <div class="modal fade" id="deleteOutModal" tabindex="-1" aria-labelledby="deleteOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/letter/surat-keluar/{id}/delete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="deleteOut_id" id="id">
                        <p>Apakah anda yakin ingin menghapus Surat Ini?</p>
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
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <nav class="rounded" aria-label="breadcrumb">
                            <ol class="breadcrumb px-3 py-2 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}"
                                        style="color: var(--bs-dark); text-decoration:none;">Dashboard</a></li>
                                <li class="breadcrumb-item active">Surat Keluar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            <div class="col-6">
                                <div class="row">
                                    <header class="page-header">
                                        <div class="page-header-content">
                                            <div class="row align-items-center justify-content-between pt-3">
                                                <div class="col-auto mb-3">
                                                    <div class="page-header-title">
                                                        <div class="page-header-icon"><i data-feather="mail"></i></div>
                                                        List Surat Keluar
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                </div>
                            </div>
                            <div class="col-6 gap-2 d-flex justify-content-end">
                                <a class="btn btn-sm btn-blue" href="{{ route('create-keluar') }}">
                                    <i data-feather="plus-square"></i> &nbsp;
                                    Tambah Surat
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('print-surat-keluar') }}" target="_blank">
                                    <i data-feather="printer"></i> &nbsp;
                                    Cetak Laporan
                                </a>
                                @if (Auth::user()->role == 'Super Admin')
                                    <a class="btn btn-sm btn-pink resetOut">
                                        <i data-feather="trash-2"></i> &nbsp;
                                        Reset All Data
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
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
                            {{-- Jquery DataTable --}}
                            <table class="table table-striped table-hover table-sm" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No. Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Tujuan Surat</th>
                                        <th>Pertalian No Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item as $items)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $items->letter_no . '/' . $items->letter_code . '/' . $items->letter_unit . '/' . $items->letter_date->format('m.Y') }}
                                            </td>
                                            <td>{{ $items->letter_date->format('d-F-Y') }}</td>
                                            <td>{{ $items->regarding }}</td>
                                            <td>{{ $items->department }}</td>
                                            <td>{{ $items->pertalian }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-xs"
                                                    href="{{ route('letter.edit', $items->id) }}">
                                                    <i class="fas fa-edit"></i> &nbsp; Ubah
                                                </a>
                                                <a class="btn btn-success btn-xs"
                                                    href="{{ route('detail-surat', $items->id) }}">
                                                    <i class="fa fa-search-plus"></i> &nbsp; Detail
                                                </a>
                                                <button class="btn btn-danger btn-xs deleteOut"
                                                    value="{{ $items->id }}">
                                                    <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush

@push('alert-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.resetOut', function(e) {
                e.preventDefault();
                $('#resetOutModal').modal('show');
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.deleteOut', function(e) {
                e.preventDefault();
                var id = $(this).val();
                $('#id').val(id);
                $('#deleteOutModal').modal('show');
            });
        });
    </script>
@endpush
