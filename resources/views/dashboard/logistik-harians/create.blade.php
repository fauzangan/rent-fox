@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Logistik Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Tambah Logistik Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Input Log Harian</h4>
        </div>
        <form action="{{ route('dashboard.logistik-harians.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2 @error('status_logistik_id') is-invalid @enderror" name="status_logistik_id">
                                @foreach($status_logistiks as $status_logistik)
                                <option value="{{ $status_logistik->status_logistik_id }}">{{ $status_logistik->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_logistik_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <select class="form-control select2 @error('order_id') is-invalid @enderror" id="order_id" name="order_id">
                                <option value="" selected>Kosong</option>
                                @foreach($orders as $order)
                                <option value="{{ $order->order_id }}" data-customer_id="{{ $order->customer_id }}">{{
                                    $order->order_id }}</option>
                                @endforeach
                            </select>
                            @error('order_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                    id="tanggal_transaksi" name="tanggal_transaksi"
                                    value="{{ old('tanggal_transaksi') }}">
                                @error('tanggal_transaksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Kode Item</label>
                            <select class="form-control select2 @error('item_id') is-invalid @enderror" id="selectItemId" name="item_id">
                                <option selected disabled>Pilih Item</option>
                            </select>
                            @error('item_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Sat.</label>
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" readonly id="satuan">
                            @error('satuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Jumlah Baik</label>
                            <input type="number" class="form-control @error('baik') is-invalid @enderror" value="0" name="baik" min="0">
                            @error('baik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Rusak Ringan</label>
                            <input type="number" class="form-control @error('x_ringan') is-invalid @enderror" value="0" name="x_ringan" min="0">
                            @error('x_ringan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Rusak Berat</label>
                            <input type="number" class="form-control @error('x_berat') is-invalid @enderror" value="0" name="x_berat" min="0">
                            @error('x_berat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control @error('jumlah_item') is-invalid @enderror" readonly name="jumlah_item" id="jumlah_item">
                            @error('jumlah_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right pt-0">
                <button type="submit" class="btn btn-primary">Tambah Log Harian</button>
            </div>
        </form>
    </div>
    <div class="row" id="biodataCustomer" style="display: none;">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Customer Id</label>
                                <input class="form-control" type="text" id="customerIdInfo" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama Customer</label>
                                <input class="form-control" type="text" id="customerNamaInfo" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input class="form-control" type="text" id="customerPerusahaanInfo" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Proyek</label>
                                <input class="form-control" type="text" id="customerProyekInfo" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Alamat Kirim</label>
                                <input class="form-control" type="text" id="customerAlamatKirimInfo" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col pr-0">
            <div class="card" id="customerOrderTable" style="display: none;">
                <div class="card-header">
                    <h4>Order Aktif Customer</h4>
                </div>
                <div class="card-body p-0" >
                    <table class="table table-md">
                        <thead>
                            <tr>
                                <th>Kode Cust</th>
                                <th>Kode Order</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col pr-0">
            <div class="card" id="orderItemsTable" style="display: none;">
                <div class="card-header">
                    <h4>Item Per Order Ini</h4>
                </div>
                <div class="card-body p-0" >
                    <table class="table table-md">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Item</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <div class="card mb-1" id="itemOrderCustomer" style="display: none;">
                        <div class="card-header">
                            <h4>Daftar Order dg. Item INI per Customer INI (Aktif dan Tutup)</h4>
                        </div>
                        <div class="card-body p-0" >
                            <table class="table table-md">
                                <thead>
                                    <tr>
                                        <th class="py-1">Kode<br> Item</th>
                                        <th class="py-1">Nama</th>
                                        <th class="py-1">Sat.</th>
                                        <th class="py-1">Jumlah<br> Item</th>
                                        <th class="py-1">Kode<br> Order</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card" id="itemOrderLogistik" style="display: none;">
                        <div class="card-header">
                            <h4>Total Trans Item INI per Order INI</h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-md">
                                <thead>
                                    <tr>
                                        <th class="py-1">Kode<br> Item</th>
                                        <th class="py-1">baik</th>
                                        <th class="py-1">x_ringan</th>
                                        <th class="py-1">x_berat</th>
                                        <th class="py-1">Jumlah<br> Item</th>
                                        <th class="py-1">Status Log</th>
                                        <th class="py-1">Kode<br> Order</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Spesific Page -->
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/page/logistik-harian-create.js') }}"></script>
<script>
    /* Pengaturan Tanggal Ditagihkan Input */
    $("#tanggal_transaksi").daterangepicker({
        locale: { format: "DD/MM/YYYY" },
        singleDatePicker: true,
        autoUpdateInput: false,
    });
    $("#tanggal_transaksi").attr(
        "placeholder",
        "dd/mm/yyyy"
    );
    $("#tanggal_transaksi").on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY"));
        }
    );
    $("#tanggal_transaksi").on(
        "cancel.daterangepicker",
        function (ev, picker) {
            $(this).val("");
        }
    );

    /* Mencegah memasukan tanggal yang salah */
    $("form").on("submit", function (e) {
        let tanggalTransaksi = $("#tanggal_transaksi").val();

        if (!moment(tanggalTransaksi, "DD/MM/YYYY", true).isValid()) {
            e.preventDefault();
            iziToast.error({
                title: "Input Tanggal Salah/Kosong",
                message:
                    "Tanggal tidak valid. Format yang benar adalah Hari/Bulan/Tahun.",
                position: "topRight",
            });
        }
    });
</script>
@endpush
@endsection