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
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_item" value="{{ old('nama_item', $item->nama_item) }}">
                </div>
                <div class="form-group">
                    <label>Harga Sewa Barang</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp
                            </div>
                        </div>
                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa', $item->harga_sewa) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Satuan Waktu Sewa</label>
                    <select class="form-control" name="satuan_waktu">
                        <option value="Bulan" @if(old('satuan_waktu', $item->satuan_waktu) == "Bulan") selected @endif>Per Bulan</option>
                        <option value="Hari" @if(old('satuan_waktu', $item->satuan_waktu) == "Hari") selected @endif>Per Hari</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan Barang</label>
                    <select class="form-control" name="satuan_item">
                        <option value="Buah" @if(old('satuan_waktu', $item->satuan_item) == "Buah") selected @endif>Buah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Barang</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp
                            </div>
                        </div>
                        <input type="text" class="form-control" name="harga_barang" id="harga_barang" value="{{ old('harga_barang', $item->harga_barang) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea type="text" class="form-control" name="keterangan">{{ old('harga_barang', $item->keterangan) }}</textarea>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Update Item</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script>
    new Cleave('#harga_sewa', {
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.'
    });

    new Cleave('#harga_barang', {
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.'
    });
</script>
@endsection