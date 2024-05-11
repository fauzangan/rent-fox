@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Item Baru</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.items.index') }}">Manajemen Item</a></div>
        <div class="breadcrumb-item">Tambah Item</div>
    </div>
</div>

<div class="section-body">
    <div class="card px-3 mx-xl-5">
        <div class="card-header">
            <h4>Formulir Data Item Baru</h4>
        </div>
        <form action="{{ route('dashboard.items.create') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_item">
                </div>
                <div class="form-group">
                    <label>Harga Sewa Barang</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp
                            </div>
                        </div>
                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa">
                    </div>
                </div>
                <div class="form-group">
                    <label>Satuan Waktu Sewa</label>
                    <select class="form-control" name="satuan_waktu">
                        <option value="Bulan">Per Bulan</option>
                        <option value="Hari">Per Hari</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan Barang</label>
                    <select class="form-control" name="satuan_item">
                        <option value="Buah">Buah</option>
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
                        <input type="text" class="form-control" name="harga_barang" id="harga_barang">
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea type="text" class="form-control" name="keterangan"></textarea>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah Item</button>
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