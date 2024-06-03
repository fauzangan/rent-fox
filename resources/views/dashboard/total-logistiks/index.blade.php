@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Total Logistik ASR</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Total Logistik</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Total Logistik
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.total-logistiks.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Total Log</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.total-logistiks.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Status Logistik</label>
                            <select class="form-control" id="status_total_logistik_id" name="status_total_logistik_id">
                                <option selected></option>
                                @foreach($status_total_logistiks as $status_total_logistik)
                                <option value="{{ $status_total_logistik->status_total_logistik_id }}" {{ request('status_total_logistik_id') == $status_total_logistik->status_total_logistik_id ? 'selected' : '' }}>{{ $status_total_logistik->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1 pr-0">
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
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" value="{{ request('tanggal_transaksi') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Data Logistik</label>
                            <select class="form-control" id="data_total_logistik_id" name="data_total_logistik_id">
                                <option selected></option>
                                @foreach($data_total_logistiks as $data_total_logistik)
                                <option value="{{ $data_total_logistik->data_total_logistik_id }}" {{ request('data_total_logistik_id') == $data_total_logistik->data_total_logistik_id ? 'selected' : '' }}>{{ $data_total_logistik->nama_data }}</option>
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
            <h4>Data Total Logistik ASR</h4>
        </div>
        <div class="card-body">
            @if($total_logistiks->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Total Log"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal<br> Entry</th>
                            <th>Status<br> Transaksi</th>
                            <th>Tanggal<br> Transaksi</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Sat.</th>
                            <th>Jumlah Item</th>
                            <th>Keterangan</th>
                            <th>Data</th>
                            <th>Vendor</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($total_logistiks as $total_logistik)
                        <tr>
                            <td>{{ $total_logistik->total_logistik_id }}</td>
                            <td>{{ $total_logistik->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($total_logistik->status_total_logistik_id == 1)
                                <span class="badge" style="background-color: teal; color:white">{{ $total_logistik->statusTotalLogistik->nama_status }}</span>
                                @else
                                <span class="badge" style="background-color:crimson; color:white">{{ $total_logistik->statusTotalLogistik->nama_status }}</span>
                                @endif
                            </td>
                            <td>{{ $total_logistik->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td>{{ $total_logistik->logistik->item_id }}</td>
                            <td>{{ $total_logistik->logistik->item->nama_item }}</td>
                            <td>{{ $total_logistik->logistik->item->satuan_item }}</td>
                            <td>{{ $total_logistik->jumlah_item }}</td>
                            <td>{{ $total_logistik->keterangan ?? '-' }}</td>
                            <td>
                                @if($total_logistik->data_total_logistik_id == 1)
                                <span class="badge badge-success" style="color: black">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @elseif($total_logistik->data_total_logistik_id == 2)
                                <span class="badge badge-warning" style="color: black">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @else
                                <span class="badge badge-danger">{{ $total_logistik->dataTotalLogistik->nama_data }}</span>
                                @endif
                            </td>
                            <td>{{ $total_logistik->vendor ?? '-' }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.total-logistiks.edit', ['totalLogistik' => $total_logistik->total_logistik_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
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
<!-- General JS Library -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Spesific Page -->
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['status_total_logistik_id', 'item_id', 'nama_item', 'data_total_logistik_id'];
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

        /* Pengaturan Tanggal Order dan Tanggal Kirim Input */
        $("#tanggal_transaksi").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            autoUpdateInput: false,
        });
        $("#tanggal_transaksi").attr("placeholder", "");

        $("#tanggal_transaksi").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
        });

        $("#tanggal_transaksi").on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
        });

        $("#filterForm").on("submit", function(e) {
            let tanggalTransaksi = $("#tanggal_transaksi").val();
            let datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;

            if(tanggalTransaksi){
                if (!datePattern.test(tanggalTransaksi)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = tanggalTransaksi.split(" - ");
                    let startDate = moment(dates[0], "DD/MM/YYYY", true);
                    let endDate = moment(dates[1], "DD/MM/YYYY", true);

                    if (!startDate.isValid() || !endDate.isValid()) {
                        e.preventDefault();
                        iziToast.error({
                            title: 'Tanggal tidak valid',
                            message: 'Harap masukkan tanggal yang benar!',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection