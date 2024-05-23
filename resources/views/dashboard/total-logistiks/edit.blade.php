@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Total Logistik ASR</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Edit Data Logistik ASR</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Logistik ASR</h4>
        </div>
        <form action="{{ route('dashboard.total-logistiks.update', ['totalLogistik' => $total_logistik->total_logistik_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Transaksi Logistik</label>
                            <select class="form-control select2 @error('status_total_logistik_id') is-invalid @enderror" name="status_total_logistik_id">
                                @foreach($status_total_logistiks as $status_total_logistik)
                                <option value="{{ $status_total_logistik->status_total_logistik_id }}" {{ old('status_total_logistik_id', $total_logistik->status_total_logistik_id) == $status_total_logistik->status_total_logistik_id ? 'selected' : '' }}>{{ $status_total_logistik->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_total_logistik_id')
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
                                    value="{{ old('tanggal_transaksi', $total_logistik->tanggal_transaksi->format('d/m/Y')) }}">
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
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan', $total_logistik->keterangan) }}">
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Data</label>
                            <select class="form-control select2 @error('data_total_logistik_id') is-invalid @enderror" name="data_total_logistik_id">
                                @foreach($data_total_logistiks as $data_total_logistik)
                                <option value="{{ $data_total_logistik->data_total_logistik_id }}" {{ old('data_total_logistik_id', $total_logistik->data_total_logistik_id) == $data_total_logistik->data_total_logistik_id ? 'selected' : '' }}>{{ $data_total_logistik->nama_data }}</option>
                                @endforeach
                            </select>
                            @error('data_total_logistik_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-2 pr-0">
                        <div class="form-group">
                            <label>Kode Item</label>
                            <select class="form-control select2 @error('logistik_id') is-invalid @enderror" name="logistik_id">
                                @foreach($logistiks as $logistik)
                                <option value="{{ $logistik->logistik_id }}" {{ old('logistik_id', $total_logistik->logistik_id) == $logistik->logistik_id ? 'selected' : '' }}>{{ $logistik->item_id }}</option>
                                @endforeach
                            </select>
                            @error('logistik_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Nama Item</label>
                            <input type="text" class="form-control @error('nama_item') is-invalid @enderror" readonly id="nama_item">
                            @error('nama_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-1 pr-0">
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
                            <label>Jumlah Item</label>
                            <input type="number" class="form-control @error('jumlah_item') is-invalid @enderror" value="{{ old('jumlah_item', $total_logistik->jumlah_item) }}" name="jumlah_item">
                            @error('jumlah_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Vendor</label>
                            <input type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" value="{{ old('vendor', $total_logistik->vendor) }}" id="vendor">
                            @error('vendor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right pt-0">
                <button type="submit" class="btn btn-warning">Edit Data Logistik ASR</button>
            </div>
        </form>
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