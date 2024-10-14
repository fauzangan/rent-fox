@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Reservasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Reservasi</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Reservasi
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.reservasis.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Reservasi</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-filter" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.reservasis.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Tanggal Reservasi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal_reservasi" id="tanggal_reservasi" value="{{ request('tanggal_reservasi') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" id="nama_customer" name="nama_customer" value="{{ request('nama_customer') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ request('nama_perusahaan') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Handphone Customer</label>
                            <input type="text" id="handphone" name="handphone" value="{{ request('handphone') }}" class="form-control">
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
            <h4>Reservasi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Kode <span data-toggle="tooltip" title="Kode Reservasi"><i class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal Reservasi</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Telp Cust</th>
                            <th>Fax Cust</th>
                            <th>Handphone</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Telp Perusahaan</th>
                            <th>Fax Perusahaan</th>
                            <th>Proyek</th>
                            <th>Keterangan</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservasis as $reservasi)
                        <tr>
                            <td>{{ $reservasi->reservasi_id }}</td>
                            <td>{{ $reservasi->tanggal_reservasi->format('d/m/Y') }}</td>
                            <td>{{ $reservasi->statusReservasi->nama_status }}</td>
                            <td>{{ $reservasi->nama_customer }}</td>
                            <td>{{ $reservasi->telp_customer?? '-' }}</td>
                            <td>{{ $reservasi->fax_customer?? '-' }}</td>
                            <td>{{ $reservasi->handphone }}</td>
                            <td>{{ $reservasi->badan_hukum?? '-' }}</td>
                            <td>{{ $reservasi->nama_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->telp_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->fax_perusahaan?? '-' }}</td>
                            <td>{{ $reservasi->proyek }}</td>
                            <td>{{ $reservasi->keterangan?? '-' }}</td>
                            <td class="sticky-aksi-col">
                                <a href="#" class="btn btn-info">Detail</a>
                                <a href="{{ route('dashboard.reservasis.edit', ['reservasi' => $reservasi->reservasi_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
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
        const fields = ['tanggal_reservasi', 'nama_customer', 'nama_perusahaan', 'handphone'];
        let formShouldShow = false;
        
        fields.forEach(field => {
            if (getQueryStringParameter(field)) {
                formShouldShow = true;
            }
        });

        if (formShouldShow) {
            $('#filterForm').show();
            $('#filterIcon').toggleClass('fa-filter fa-minus');
        }

        $('#filterButton').click(function() {
            $('#filterForm').toggle('slow', 'swing');
            $('#filterIcon').toggleClass('fa-filter fa-minus');
        });

        /* Pengaturan Tanggal Order dan Tanggal Kirim Input */
        $("#tanggal_reservasi").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            autoUpdateInput: false,
        });

        $("#tanggal_reservasi").attr("placeholder", "");

        $("#tanggal_reservasi").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
        });

        $("#tanggal_reservasi").on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
        });

        $("#filterForm").on("submit", function(e) {
            let tanggalReservasi = $("#tanggal_reservasi").val();
            let datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;

            if(tanggalReservasi){
                if (!datePattern.test(tanggalReservasi)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = tanggalReservasi.split(" - ");
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