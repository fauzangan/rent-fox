@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Item</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.items.index') }}">Manajemen Item</a></div>
        <div class="breadcrumb-item">Edit Data Item</div>
    </div>
</div>

<div class="section-body">
    <div class="card px-3 mx-xl-5">
        <div class="card-header">
            <h4>Edit Data Item ID: {{ $item->item_id }}</h4>
        </div>
        <form action="{{ route('dashboard.items.update', ['item' => $item->item_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control @error('nama_item') is-invalid @enderror" name="nama_item" value="{{ old('nama_item', $item->nama_item) }}">
                            @error('nama_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori<span class="text-danger" data-toggle="tooltip" title="Wajib Diisi!">*</span></label>
                            <select class="form-control @error('category_item_id') is-invalid @enderror" name="category_item_id">
                                @foreach($category_items as $category_item)
                                @if($category_item->category_item_id == $item->category_item_id)
                                <option value="{{ $category_item->category_item_id }}" selected>{{ $category_item->nama_category }}</option>
                                @else
                                <option value="{{ $category_item->category_item_id }}">{{ $category_item->nama_category }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('category_item_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Harga Sewa Barang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('harga_sewa') is-invalid @enderror" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa', $item->harga_sewa) }}">
                                @error('harga_sewa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Satuan Waktu Sewa</label>
                            <select class="form-control @error('satuan_waktu') is-invalid @enderror" name="satuan_waktu">
                                <option value="Bulan" @if(old('satuan_waktu', $item->satuan_waktu) == "Bulan") selected @endif>Per Bulan</option>
                                <option value="Hari" @if(old('satuan_waktu', $item->satuan_waktu) == "Hari") selected @endif>Per Hari</option>
                            </select>
                            @error('satuan_waktu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Satuan Barang</label>
                            <select class="form-control @error('satuan_item') is-invalid @enderror" name="satuan_item">
                                <option value="Buah" @if(old('satuan_item', $item->satuan_item) == "Buah") selected @endif>Buah</option>
                            </select>
                            @error('satuan_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Harga Barang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('harga_barang') is-invalid @enderror" name="harga_barang" id="harga_barang" value="{{ old('harga_barang', $item->harga_barang) }}">
                                @error('harga_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Claim Kerusakan Ringan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('x_ringan') is-invalid @enderror" name="x_ringan" id="x_ringan" value="{{ old('x_ringan', $item->x_ringan) }}">
                                @error('x_ringan')
                                <div class="invalid-feedback">
                                    Wajib Diisi
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Claim Kerusakan Berat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                        <input type="number" class="form-control @error('x_berat') is-invalid @enderror" name="x_berat" id="x_berat" value="{{ old('x_berat', $item->x_berat*100) }}" min=0>
                                        @error('x_berat')
                                        <div class="invalid-feedback">
                                            Wajib Diisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Claim Kehilangan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                        <input type="number" class="form-control @error('hilang') is-invalid @enderror" name="hilang" id="hilang" value="{{ old('hilang', $item->hilang*100) }}" min=0>
                                        @error('hilang')
                                        <div class="invalid-feedback">
                                            Wajib Diisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Stock Awal</label>
                                    <input type="number" class="form-control @error('stock_awal') is-invalid @enderror" disabled name="stock_awal" value="{{ old('stock_awal', $item->logistik->stock_awal) }}">
                                    @error('stock_awal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tambah/Kurang Stock</label>
                                    <input type="number" class="form-control @error('total_log') is-invalid @enderror" name="total_log" id="total_log" value="{{ old('total_log') }}" min="-{{ $item->logistik->total_stock }}">
                                    @error('total_log')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Stock Gudang</label>
                                    <input type="text" class="form-control @error('total_stock') is-invalid @enderror" data-initial="{{ $item->logistik->total_stock }}" name="total_stock" id="total_stock" disabled>
                                    @error('total_stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $item->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Update Item</button>
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
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/js/page/item-edit.js') }}"></script>
@endpush


@endsection