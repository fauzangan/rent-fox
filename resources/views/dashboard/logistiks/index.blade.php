@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Logistik</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Logistik</div>
    </div>
</div>

<div class="section-body">
    <div class="section-title my-3">
        Data Logistik
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-md">
                <thead>
                    <tr class="text-center">
                        <th style="background-color: #1a1aff; color:#f8f9fa">Kode Item</th>
                        <th style="background-color: #1a1aff; color:#f8f9fa">Nama Item</th>
                        <th style="background-color: #1a1aff; color:#f8f9fa">Sat.</th>
                        <th style="background-color: #cc0000; color:#f8f9fa">Stock<br> Awal</th>
                        <th style="background-color: #cc0000; color:#f8f9fa">Total<br> Log</th>
                        <th style="background-color: #cc0000; color:#f8f9fa">Claim<br> Hilang</th>
                        <th style="background-color: #cc0000; color:#f8f9fa">Total<br> Stock</th>
                        <th style="background-color: #ff661a; color:#f8f9fa">Log<br>Harian<br>Baik</th>
                        <th style="background-color: #ff661a; color:#f8f9fa">Log<br>Harian<br>xRingan</th>
                        <th style="background-color: #ff661a; color:#f8f9fa">Log<br>Harian<br>xBerat</th>
                        <th style="background-color: #ff661a; color:#f8f9fa">Total<br>Log<br>Harian</th>
                        <th style="background-color: #002b80; color:#f8f9fa">Total<br> Rental</th>
                        <th style="background-color: #1a1aff; color:#f8f9fa">Stock<br> Gudang</th>
                        <th style="background-color: #1a1aff; color:#f8f9fa">Reserve</th>
                        <th style="background-color: #1a1aff; color:#f8f9fa">Stock<br> Gudang<br> Ready</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logistiks as $logistik)
                    <tr>
                        <td>{{ $logistik->item_id }}</td>
                        <td>{{ $logistik->item->nama_item }}</td>
                        <td>{{ $logistik->item->satuan_item }}</td>
                        <td>{{ $logistik->stock_awal }}</td>
                        <td>{{ $logistik->total_log }}</td>
                        <td>{{ $logistik->claim_hilang }}</td>
                        <td>{{ $logistik->total_stock }}</td>
                        <td>{{ $logistik->baik }}</td>
                        <td>{{ $logistik->x_ringan }}</td>
                        <td>{{ $logistik->x_berat }}</td>
                        <td>{{ $logistik->total_rental }}</td>
                        <td>0</td>
                        <td>{{ $logistik->stock_gudang }}</td>
                        <td>{{ $logistik->reserve }}</td>
                        <td>{{ $logistik->stock_ready }}</td>
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
    .header-1 {
        background-color: blue;
        /* Warna latar belakang */
        color: #f8f9fa;
        /* Warna teks */
        text-align: center;
        /* Rata tengah teks */
    }
</style>
@endpush

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