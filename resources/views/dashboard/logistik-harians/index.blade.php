@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Logistik/Gudang Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Logistik/Gudang Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Logistik Harian
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.logistik-harians.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Log Harian</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Semua Data Logistik Harian</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Log Harian"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tgl Entry</th>
                            <th>Status</th>
                            <th>Kode Order</th>
                            <th>Tgl Trans</th>
                            <th>Kode Cust</th>
                            <th>Keterangan</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Baik</th>
                            <th>xRingan</th>
                            <th>xBerat</th>
                            <th>Customer</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logistik_harians as $logistik_harian)
                        <tr>
                            <td>{{ $logistik_harian->logistik_harian_id }}</td>
                            <td>{{ $logistik_harian->created_at->format('d/m/Y') }}</td>
                            <td>{{ $logistik_harian->statusLogistik->nama_status }}</td>
                            <td>{{ $logistik_harian->order_id }}</td>
                            <td>{{ $logistik_harian->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td>{{ $logistik_harian->order->customer_id }}</td>
                            <td>{{ $logistik_harian->keterangan?? '-' }}</td>
                            <td>{{ $logistik_harian->logistik->item_id }}</td>
                            <td>{{ $logistik_harian->logistik->item->nama_item }}</td>
                            <td>{{ $logistik_harian->baik }}</td>
                            <td>{{ $logistik_harian->x_ringan }}</td>
                            <td>{{ $logistik_harian->x_berat }}</td>
                            <td>{{ $logistik_harian->order->customer->nama }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.logistik-harians.edit', ['logistikHarian' => $logistik_harian->logistik_harian_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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
<!-- General JS Library -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Spesific Page -->
@endpush
@endsection