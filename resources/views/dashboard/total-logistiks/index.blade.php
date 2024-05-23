@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Total Logistik</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Total Logistik</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Total Logistik
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.total-logistiks.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Total Log</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Total Log Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Total Log"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal<br> Entry</th>
                            <th>Status<br> Transaksi</th>
                            <th>Tanggal<br> Transaksi</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Sat.</th>
                            <th>Jumlah Item</th>
                            <th>Keterangan</th>
                            <th>Data</th>
                            <th>Vendor</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($total_logistiks as $total_logistik)
                        <tr>
                            <td>{{ $total_logistik->total_logistik_id }}</td>
                            <td>{{ $total_logistik->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($total_logistik->status_total_logistik_id == 1)
                                <span class="badge" style="background-color: teal; color:white">{{ $total_logistik->statusTotalLogistik->nama_status }}</span>
                                @else
                                <span class="badge" style="background-color:crimson; color:white">{{ $total_logistik->statusTotalLogistik->nama_status }}</span>
                                @endif
                            </td>
                            <td>{{ $total_logistik->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td>{{ $total_logistik->logistik->item_id }}</td>
                            <td>{{ $total_logistik->logistik->item->nama_item }}</td>
                            <td>{{ $total_logistik->logistik->item->satuan_item }}</td>
                            <td>{{ $total_logistik->jumlah_item }}</td>
                            <td>{{ $total_logistik->keterangan ?? '-' }}</td>
                            <td>
                                @if($total_logistik->data_total_logistik_id == 1)
                                <span class="badge badge-success" style="color: black">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @elseif($total_logistik->data_total_logistik_id == 2)
                                <span class="badge badge-warning" style="color: black">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @else
                                <span class="badge badge-danger">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @endif
                            </td>
                            <td>{{ $total_logistik->vendor ?? '-' }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.total-logistiks.edit', ['totalLogistik' => $total_logistik->total_logistik_id]) }}" class="btn btn-warning">Edit</a>
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