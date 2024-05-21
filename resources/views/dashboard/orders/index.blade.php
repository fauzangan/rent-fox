@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Order</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Order
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Order</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Order Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Kode Order <span data-toggle="tooltip" title="Kode Order"><i
                                        class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal Order</th>
                            <th>Tanggal Kirim</th>
                            <th>Kode Cust</th>
                            <th>Nama Cust</th>
                            <th>Alamat Cust</th>
                            <th>Kota Cust</th>
                            <th>Telp Cust</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Kirim Kepada</th>
                            <th>Proyek</th>
                            <th>Alamat Kirim</th>
                            <th>Keterangan</th>
                            <th>Transport</th>
                            <th>Status Order</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->tanggal_order->format('d/m/Y') }}</td>
                            <td>{{ $order->tanggal_kirim->format('d/m/Y') }}</td>
                            <td>{{ $order->customer_id }}</td>
                            <td>{{ $order->nama_customer }}</td>
                            <td>{{ $order->alamat_customer }}</td>
                            <td>{{ $order->kota_customer }}</td>
                            <td>{{ $order->telp_customer }}</td>
                            <td>{{ $order->badan_hukum }}</td>
                            <td>{{ $order->nama_perusahaan }}</td>
                            <td>{{ $order->kirim_kepada }}</td>
                            <td>{{ $order->nama_proyek }}</td>
                            <td>{{ $order->alamat_kirim }}</td>
                            <td>{{ $order->keterangan }}</td>
                            <td>
                                @if($order->status_transport == 1)
                                Oleh ASR
                                @else
                                Mandiri
                                @endif
                            </td>
                            <td>{{ $order->status_order }}</td>
                            <td class="sticky-aksi-col">
                                <button class="btn btn-info" id="detail-button" data-id={{ $order->order_id
                                    }}>Detail</button>
                                <a href="{{ route('dashboard.orders.edit', ['order' => $order->order_id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <a href="{{ route('dashboard.orders.delete', ['order' => $order->order_id]) }}"
                                    class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $orders->links() }}
            </nav>
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