@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Logistik</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Logistik</div>
    </div>
</div>

<div class="section-body">
    <div class="section-title my-3">
        Data Logistik
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.logistiks.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-2 pr-0">
                        <div class="form-group">
                            <label>Kode Item</label>
                            <input type="text" id="item_id" name="item_id" value="{{ request('item_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Item</label>
                            <input type="text" id="nama_item" name="nama_item" value="{{ request('nama_item') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Kategori Item</label>
                            <select class="form-control" id="category_item_id" name="category_item_id">
                                <option selected></option>
                                @foreach($category_items as $category_item)
                                <option value="{{ $category_item->category_item_id }}" {{ request('category_item_id') == $category_item->category_item_id ? 'selected' : '' }}>{{ $category_item->nama_category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right py-0 pr-0">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if($logistiks->count() == 0)
            <h4 class="text-center p-4 m-4">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-md">
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
                            <td>{{ $logistik->total_harian_log }}</td>
                            <td>{{ $logistik->total_rental }}</td>
                            <td>{{ $logistik->stock_gudang }}</td>
                            <td>{{ $logistik->reservasi }}</td>
                            <td>{{ $logistik->stock_ready }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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

<!-- Spesific JS File -->
<script>
    $(document).ready(function() {
        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['item_id', 'nama_item', 'category_item_id'];
        let formShouldShow = false;
        
        fields.forEach(field => {
            if (getQueryStringParameter(field)) {
                formShouldShow = true;
            }
        });

        if (formShouldShow) {
            $('#filterForm').show();
            $('#filterIcon').toggleClass('fa-plus fa-minus');
        }

        $('#filterButton').click(function() {
            $('#filterForm').toggle('slow', 'swing');
            $('#filterIcon').toggleClass('fa-plus fa-minus');
        });
    });
</script>
@endpush
@endsection