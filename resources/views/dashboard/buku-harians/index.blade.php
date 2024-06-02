@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Buku Harian Accounting</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Buku Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Buku Harian
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.buku-harians.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Harian</a>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.items.index') }}" method="GET">
                @csrf
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
    </div> --}}

    <div class="card">
        <div class="card-header">
            <h4>Buku Harian Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No.<br> Trans <span data-toggle="tooltip" title="Kode Barang"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal<br> Entry</th>
                            <th>Tanggal<br> Transaksi</th>
                            <th>Kode<br> Posting</th>
                            <th>Nama<br> Posting</th>
                            <th>Kode<br> Order</th>
                            <th>Kode<br> Cust</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buku_harians as $buku_harian)
                        <tr>
                            <td>{{ $buku_harian->buku_harian_id }}</td>
                            <td>{{ $buku_harian->created_at->format('d/m/Y') }}</td>
                            <td>{{ $buku_harian->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td><span class="badge badge-secondary">{{ $buku_harian->posting_biaya_id }}</span></td>
                            <td><span class="badge badge-secondary">{{ $buku_harian->postingBiaya->nama_posting }}</span></td>
                            <td>
                                @if(isset($buku_harian->order_id))
                                {{ $buku_harian->order_id }}
                                @else
                                <span class="badge badge-secondary">dihapus</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($buku_harian->order->customer_id))
                                {{ $buku_harian->order->customer_id }}
                                @else
                                <span class="badge badge-secondary">dihapus</span>
                                @endif
                            </td>
                            <td>{{ $buku_harian->keterangan }}</td>
                            <td><span class="badge badge-currency" style="background-color:darkblue; color:white;">Rp {{ number_format($buku_harian->debit,0,",",".").',-' }}</span></td>
                            <td><span class="badge badge-currency" style="background-color:steelblue; color:white;">Rp {{ number_format($buku_harian->kredit,0,",",".").',-' }}</span></td>
                            <td><span class="badge badge-currency" style="background-color: teal; color:white;">Rp {{ number_format($buku_harian->saldo,0,",",".").',-' }}</span></td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.buku-harians.edit', ['bukuHarian' => $buku_harian->buku_harian_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                
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

    .badge-currency {
        border-radius: 5px !important;
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