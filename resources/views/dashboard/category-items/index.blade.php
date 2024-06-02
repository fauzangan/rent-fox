@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Kategori Items</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Kategori Items</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Kategori Item
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.category-items.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kategori</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Kategori Item Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap text-center">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama<br> Kategori</th>
                            <th>Prefiks<br> Kode Item</th>
                            <th>Total<br> Items</th>
                            <th>Keterangan</th>
                            <th>Tanggal<br> Diupdate</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category_items as $category_item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category_item->nama_category }}</td>
                            <td><span class="badge badge-secondary">{{ $category_item->prefiks }}</span></td>
                            <td><span class="badge badge-primary">{{ $category_item->items->count() }}</span></td>
                            <td>{{ $category_item->keterangan }}</td>
                            <td>{{ $category_item->updated_at->translatedFormat('d F Y') }}</td>
                            <td>
                                <a href="{{ route('dashboard.category-items.edit', ['categoryItem' => $category_item->category_item_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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