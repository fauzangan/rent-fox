@extends('dashboard.layouts.main')
@section('content')

<div class="section-header">
    <h1>Jatuh Tempo Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Jatuh Tempo Order</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Jatuh Tempo Order</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                @if($orders->count() == 0)
                <h4 class="text-center">Tidak ada Data</h4>
                @else
                <table class="table table-bordered table-hover table-md">
                    <thead>
                        <tr>
                            <th style="text-center">Kode Cust.</th>
                            <th>Tanggal<br> Kirim</th>
                            <th>Bulan<br> Ke</th>
                            <th>Jatuh<br> Tempo Ini</th>
                            <th>Kode<br> Order</th>
                            <th>Nama<br> Cust.</th>
                            <th>Perusahaan</th>
                            <th>Nama Proyek</th>
                            <th>Alamat Kirim</th>
                            <th>Telp. Cust</th>
                            <th>Fax Cust</th>
                            <th>HP</th>
                            <th>Telp. Perush</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->customer_id }}</td>
                            <td>{{ $order->tanggal_kirim->format('d/m/Y') }}</td>
                            <td>1</td>
                            <th>1</th>
                            <td class="text-center">{{ $order->order_id }}</td>
                            <td>{{ $order->customer->nama }}</td>
                            <td>{{ $order->customer->perusahaan->badan_hukum ?? '-' }} {{ $order->customer->perusahaan->nama ?? '' }}</td>
                            <td>{{ $order->nama_proyek ?? '-' }}</td>
                            <td>{{ $order->alamat_kirim }}</td>
                            <td>{{ $order->customer->telp ?? '-' }}</td>
                            <td>{{ $order->customer->fax ?? '-' }}</td>
                            <td>{{ $order->customer->handphone ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->telp ?? '-' }}</td>
                            <td>
                                @if($order->statusOrder->status_order_id == 1)
                                <span class="badge badge-success" style="color: black">{{
                                    $order->statusOrder->nama_status }}</span>     
                                @else
                                <span class="badge badge-danger">{{ $order->statusOrder->nama_status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $orders->links() }}
            </nav>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
@endpush
@endsection