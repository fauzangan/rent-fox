@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Buku Harian Accounting</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Buku Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Buku Harian
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.buku-harians.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Harian</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.buku-harians.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Cust</label>
                            <input type="text" id="customer_id" name="customer_id" value="{{ request('customer_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-3 pr-0">
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
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Group Biaya</label>
                            <select class="form-control" id="group_biaya_id" name="group_biaya_id">
                                <option selected></option>
                                @foreach($group_biayas as $group_biaya)
                                <option value="{{ $group_biaya->group_biaya_id }}" {{ request('group_biaya_id') == $group_biaya->group_biaya_id ? 'selected' : '' }}>(Kode Group: {{ $group_biaya->prefiks }} ) | {{ $group_biaya->nama_group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Posting Biaya</label>
                            <select class="form-control" id="posting_biaya_id" name="posting_biaya_id">
                                <option selected></option>
                                @foreach($group_biayas as $group_biaya)
                                <optgroup label="{{ $group_biaya->nama_group }} (Kode Group: {{ $group_biaya->prefiks }})">
                                    @foreach($group_biaya->postingBiayas as $posting_biaya)
                                    <option value="{{ $posting_biaya->posting_biaya_id }}" {{ request('posting_biaya_id') == $posting_biaya->posting_biaya_id ? 'selected' : '' }}>{{ $posting_biaya->posting_biaya_id }} | {{ $posting_biaya->nama_posting }}</option>
                                    @endforeach
                                </optgroup>
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
            <h4>Buku Harian Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No.<br> Trans <span data-toggle="tooltip" title="Kode Barang"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal<br> Entry</th>
                            <th>Tanggal<br> Transaksi</th>
                            <th>Kode<br> Posting</th>
                            <th>Nama<br> Posting</th>
                            <th>Kode<br> Order</th>
                            <th>Kode<br> Cust</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buku_harians as $buku_harian)
                        <tr>
                            <td>{{ $buku_harian->buku_harian_id }}</td>
                            <td>{{ $buku_harian->created_at->format('d/m/Y') }}</td>
                            <td>{{ $buku_harian->tanggal_transaksi->format('d/m/Y') }}</td>
                            <td><span class="badge badge-secondary">{{ $buku_harian->posting_biaya_id }}</span></td>
                            <td><span class="badge badge-secondary">{{ $buku_harian->postingBiaya->nama_posting }}</span></td>
                            <td>
                                @if(isset($buku_harian->order_id))
                                {{ $buku_harian->order_id }}
                                @else
                                <span class="badge badge-secondary">dihapus</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($buku_harian->order->customer_id))
                                {{ $buku_harian->order->customer_id }}
                                @else
                                <span class="badge badge-secondary">dihapus</span>
                                @endif
                            </td>
                            <td>{{ $buku_harian->keterangan }}</td>
                            <td><span class="badge badge-currency" style="background-color:darkblue; color:white;">Rp {{ number_format($buku_harian->debit,0,",",".").',-' }}</span></td>
                            <td><span class="badge badge-currency" style="background-color:steelblue; color:white;">Rp {{ number_format($buku_harian->kredit,0,",",".").',-' }}</span></td>
                            <td><span class="badge badge-currency" style="background-color: teal; color:white;">Rp {{ number_format($buku_harian->saldo,0,",",".").',-' }}</span></td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.buku-harians.edit', ['bukuHarian' => $buku_harian->buku_harian_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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

    .badge-currency {
        border-radius: 5px !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Spesific JS File -->
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
        const fields = ['order_id', 'customer_id', 'tanggal_transaksi', 'group_biaya_id', 'posting_biaya_id'];
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