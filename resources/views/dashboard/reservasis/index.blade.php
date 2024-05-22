@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Reservasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Reservasi</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Reservasi
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.reservasis.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Reservasi</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Reservasi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Kode <span data-toggle="tooltip" title="Kode Reservasi"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal Reservasi</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Telp Cust</th>
                            <th>Fax Cust</th>
                            <th>Handphone</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Telp Perusahaan</th>
                            <th>Fax Perusahaan</th>
                            <th>Proyek</th>
                            <th>Keterangan</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservasis as $reservasi)
                        <tr>
                            <td>{{ $reservasi->reservasi_id }}</td>
                            <td>{{ $reservasi->tanggal_reservasi->format('d/m/Y') }}</td>
                            <td>{{ $reservasi->statusReservasi->nama_status }}</td>
                            <td>{{ $reservasi->nama_customer }}</td>
                            <td>{{ $reservasi->telp_customer?? '-' }}</td>
                            <td>{{ $reservasi->fax_customer?? '-' }}</td>
                            <td>{{ $reservasi->handphone }}</td>
                            <td>{{ $reservasi->badan_hukum?? '-' }}</td>
                            <td>{{ $reservasi->nama_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->telp_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->fax_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->proyek }}</td>
                            <td>{{ $reservasi->keterangan?? '-' }}</td>
                            <td class="sticky-aksi-col">
                                <a href="#" class="btn btn-info">Detail</a>
                                <a href="{{ route('dashboard.reservasis.edit', ['reservasi' => $reservasi->reservasi_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .sticky-aksi-head {
        position: sticky;
        right: 0;
        z-index: 999;
        background-color: #f5f5f5 !important;
        /* Warna latar belakang */
    }

    .sticky-aksi-col {
        position: sticky;
        right: 0;
        z-index: 999;
        background-color: #ffffff !important;
        /* Warna latar belakang */
    }
</style>
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->

@endpush
@endsection