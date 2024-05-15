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
            <a href="{{ route('dashboard.category-items.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Tagihan</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tagihan Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Tagihan"><i class="fas fa-question-circle"></i></span></th>
                            <th>Nama Kategori</th>
                            <th>Prefiks Kode Item</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category_items as $category_item)
                        <tr>
                            <td>{{ $category_item->category_item_id }}</td>
                            <td>{{ $category_item->nama_category }}</td>
                            <td>{{ $category_item->prefiks }}</td>
                            <td>{{ $category_item->keterangan }}</td>
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