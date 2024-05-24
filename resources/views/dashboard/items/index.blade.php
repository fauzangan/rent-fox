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
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Item Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-md">
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
                            <th>Tanggal Diupdate</th>
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
                            <td>
                                <span class="badge" style="background-color: #0080ff; color:white">Rp {{ number_format($item->harga_sewa,0,",",".").',-' }}</span>
                            </td>
                            <td>Per {{ $item->satuan_waktu }}</td>
                            <td>
                                <span class="badge" style="background-color: #0000b3; color:white">Rp {{ number_format($item->harga_barang,0,",",".").',-' }}</span>
                            </td>
                            <td>
                                <span class="badge" style="background-color: #ff9933; color:white">Rp {{ number_format($item->x_ringan,0,",",".").',-' }}</td></span>
                                
                            <td>
                                <span class="badge" style="background-color: #ff8000; color:white">{{ $item->x_berat*100 }}%</td></span>    
                            </td>
                            <td>
                                <span class="badge" style="background-color: #e67300; color:white">{{ $item->hilang*100 }}%</td></span>
                            </td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->updated_at->translatedFormat('d F Y') }}</td>
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