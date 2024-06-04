@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Kategori Items</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.category-items.index') }}">Category Items</a></div>
        <div class="breadcrumb-item">Edit Category</div>
    </div>
</div>

<div class="section-body">
    <div class="card px-3 mx-xl-5">
        <div class="card-header">
            <h4>Formulir Data Kategori Item Baru</h4>
        </div>
        <form action="{{ route('dashboard.category-items.update', ['categoryItem' => $categoryItem->category_item_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control @error('nama_category') is-invalid @enderror" name="nama_category" value="{{ old('nama_category', $categoryItem->nama_category) }}">
                    @error('nama_category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Prefiks Kode Item</label>
                    <input type="text" class="form-control @error('prefiks') is-invalid @enderror" name="prefiks" value="{{ old('prefiks', $categoryItem->prefiks) }}">
                    @error('prefiks')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $categoryItem->keterangan) }}</textarea>
                    @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Edit Kategori Item</button>
                </div>
            </div>
        </form>
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