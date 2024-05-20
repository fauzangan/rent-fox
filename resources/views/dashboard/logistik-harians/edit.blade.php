@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Data Logistik Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.logistik-harians.index') }}">Logistik Harian</a></div>
        <div class="breadcrumb-item">Edit Logistik Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Log Harian ID: {{ $logistik_harian->logistik_harian_id }}</h4>
        </div>
        <form action="{{ route('dashboard.logistik-harians.update', ['logistikHarian' => $logistik_harian->logistik_harian_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2 @error('status_logistik_id') is-invalid @enderror" name="status_logistik_id">
                                @foreach($status_logistiks as $status_logistik)
                                    @if(old('status_logistik_id', $logistik_harian->status_logistik_id) == $status_logistik->status_logistik_id )
                                        <option value="{{ $status_logistik->status_logistik_id }}" selected>{{ $status_logistik->nama_status }}</option>
                                    @else
                                        <option value="{{ $status_logistik->status_logistik_id }}">{{ $status_logistik->nama_status }}</option>
                                    @endif
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
                            <input type="text" class="form-control" readonly id="order_id" name="order_id" value="{{ $logistik_harian->order_id }}" data-customer_id="{{ $logistik_harian->order->customer_id }}" data-item_id="{{ $logistik_harian->logistik->item_id }}">
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
                                <input type="text" class="form-control @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', $logistik_harian->tanggal_transaksi->format('d/m/Y')) }}">
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
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan', $logistik_harian->keterangan) }}">
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
                            <select class="form-control disabled @error('item_id') is-invalid @enderror" readonly id="selectItemId" id="logistik_id" name="logistik_id">
                                <option selected value="{{ $logistik_harian->logistik_id }}">{{ $logistik_harian->logistik->item_id }} | {{ $logistik_harian->logistik->item->nama_item }}</option>
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
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" readonly id="satuan" value="{{ $logistik_harian->logistik->item->satuan_item }}">
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
                            <input type="number" class="form-control @error('baik') is-invalid @enderror" value="{{ old('baik', $logistik_harian->baik) }}" name="baik">
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
                            <input type="number" class="form-control @error('x_ringan') is-invalid @enderror" value="{{ old('x_ringan', $logistik_harian->x_ringan) }}" name="x_ringan">
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
                            <input type="number" class="form-control @error('x_berat') is-invalid @enderror" value="{{ old('x_berat', $logistik_harian->x_berat) }}" name="x_berat">
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
                            <input type="text" class="form-control @error('jumlah_item') is-invalid @enderror" readonly name="jumlah_item" id="jumlah_item" value="{{ old('jumlah_item', $logistik_harian->jumlah_item) }}">
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
                <button type="submit" class="btn btn-primary">Edit Data Log Harian</button>
            </div>
        </form>
    </div>
    <div class="row" id="biodataCustomer" style="display: none;">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body py-0">
                    <div class="row">
                        <div class="col-md-auto">
                            <p><strong>Kode Cust:</strong> <span id="customerIdInfo"></span></p>
                        </div>
                        <div class="col-md-auto">
                            <p><strong>Nama:</strong> <span id="customerNamaInfo"></span></p>
                        </div>
                        <div class="col-md-auto">
                            <p><strong>Perusahaan:</strong> <span id="customerPerusahaanInfo"></span></p>
                        </div>
                        <div class="col-md-auto">
                            <p><strong>Proyek:</strong> <span id="customerProyekInfo"></span></p>
                        </div>
                        <div class="col-md-auto">
                            <p><strong>Alamat Kirim:</strong> <span id="customerAlamatKirimInfo"></span></p>
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
                                <th>Item ID</th>
                                <th>Item Name</th>
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
                    <div class="card mb-1" id="itemOrderLogistik" style="display: none;">
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
            <div class="row">
                <div class="col">
                    <div class="card" id="itemOrderCustomer" style="display: none;">
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
<script src="{{ asset('assets/js/page/logistik-harian-edit.js') }}"></script>
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