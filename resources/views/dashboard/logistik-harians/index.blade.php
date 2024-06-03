@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Logistik/Gudang Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Logistik/Gudang Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Logistik Harian
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.logistik-harians.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Log Harian</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.logistik-harians.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Status Logistik</label>
                            <select class="form-control" id="status_logistik_id" name="status_logistik_id">
                                <option selected></option>
                                @foreach($status_logistiks as $status_logistik)
                                <option value="{{ $status_logistik->status_logistik_id }}" {{ request('status_logistik_id') == $status_logistik->status_logistik_id ? 'selected' : '' }}>{{ $status_logistik->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Item</label>
                            <input type="text" id="item_id" name="item_id" value="{{ request('item_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Cust</label>
                            <input type="text" id="customer_id" name="customer_id" value="{{ request('customer_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Item</label>
                            <input type="text" id="nama_item" name="nama_item" value="{{ request('nama_item') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
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
            <h4>Semua Data Logistik Harian</h4>
        </div>
        <div class="card-body">
            @if($logistik_harians->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Log Harian"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal<br> Entry</th>
                            <th>Status</th>
                            <th>Kode<br> Order</th>
                            <th>Tanggal<br> Trans</th>
                            <th>Kode<br> Cust</th>
                            <th>Keterangan</th>
                            <th>Kode<br> Item</th>
                            <th>Nama<br> Item</th>
                            <th>Baik</th>
                            <th>xRingan</th>
                            <th>xBerat</th>
                            <th>Customer</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logistik_harians as $logistik_harian)
                        <tr>
                            <td>{{ $logistik_harian->logistik_harian_id }}</td>
                            <td>{{ $logistik_harian->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($logistik_harian->status_logistik_id == 1)
                                <span class="badge" style="background-color: teal; color:white">{{ $logistik_harian->statusLogistik->nama_status }}</span>
                                @else
                                <span class="badge" style="background-color: rgb(138, 11, 167); color:white">{{ $logistik_harian->statusLogistik->nama_status }}</span>
                                @endif
                            </td>
                            <td>{{ $logistik_harian->order_id }}</td>
                            <td>{{ $logistik_harian->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td>{{ $logistik_harian->order->customer_id }}</td>
                            <td>{{ $logistik_harian->keterangan?? '-' }}</td>
                            <td>{{ $logistik_harian->logistik->item_id }}</td>
                            <td>{{ $logistik_harian->logistik->item->nama_item }}</td>
                            <td>{{ $logistik_harian->baik }}</td>
                            <td>{{ $logistik_harian->x_ringan }}</td>
                            <td>{{ $logistik_harian->x_berat }}</td>
                            <td>{{ $logistik_harian->order->customer->nama }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.logistik-harians.edit', ['logistikHarian' => $logistik_harian->logistik_harian_id]) }}" class="btn btn-warning">Edit</a>
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
        const fields = ['status_logistik_id', 'order_id', 'item_id', 'customer_id', 'nama_item', 'tanggal_transaksi'];
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