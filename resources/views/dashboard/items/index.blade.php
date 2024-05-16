@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Item</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Item</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Item
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.items.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Item</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Item Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Barang"><i class="fas fa-question-circle"></i></span></th>
                            <th>Nama Item</th>
                            <th>Kategori Item</th>
                            <th>Harga Sewa</th>
                            <th>Satuan Waktu</th>
                            <th>Harga Barang</th>
                            <th>Claim<br> Rusak Ringan</th>
                            <th>Claim<br> Rusak Berat</th>
                            <th>Claim<br> Hilang</th>
                            <th>Keterangan</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->item_id }}</td>
                            <td>{{ $item->nama_item }}</td>
                            @if(isset($item->categoryItem))
                                <td>{{ $item->categoryItem->nama_category }}</td>
                            @else
                                <td><span class="badge badge-danger">Not Set</span></td>
                            @endif
                            <td>Rp {{ number_format($item->harga_sewa,0,",",".").',-' }}</td>
                            <td>Per {{ $item->satuan_waktu }}</td>
                            <td>Rp {{ number_format($item->harga_barang,0,",",".").',-' }}</td>
                            <td>Rp {{ number_format($item->x_ringan,0,",",".").',-' }}</td>
                            <td>{{ $item->x_berat*100 }}%</td>
                            <td>{{ $item->hilang*100 }}%</td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.items.edit', ['item' => $item->item_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('dashboard.items.delete', ['item' => $item->item_id]) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $items->links() }}
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
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
@endpush
@endsection