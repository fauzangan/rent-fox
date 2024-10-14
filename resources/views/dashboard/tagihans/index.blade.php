@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Tagihan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Tagihan</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Tagihan
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.tagihans.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Tagihan</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-filter" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.tagihans.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Tagihan</label>
                            <input type="text" id="tagihan_id" name="tagihan_id" value="{{ request('tagihan_id') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Cust</label>
                            <input type="text" id="customer_id" name="customer_id" value="{{ request('customer_id') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Cust</label>
                            <input type="text" id="nama_customer" name="nama_customer" value="{{ request('nama_customer') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ request('nama_perusahaan') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Jenis Tagihan</label>
                            <select class="form-control" id="jenis_tagihan_id" name="jenis_tagihan_id">
                                <option selected></option>
                                @foreach($jenis_tagihans as $jenis_tagihan)
                                <option value="{{ $jenis_tagihan->jenis_tagihan_id }}" {{ request('jenis_tagihan_id') == $jenis_tagihan->jenis_tagihan_id ? 'selected' : '' }}>{{ $jenis_tagihan->nama_tagihan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Status Tagihan</label>
                            <select class="form-control" id="status_tagihan_id" name="status_tagihan_id">
                                <option selected></option>
                                @foreach($status_tagihans as $status_tagihan)
                                <option value="{{ $status_tagihan->status_tagihan_id }}" {{ request('status_tagihan_id') == $status_tagihan->status_tagihan_id ? 'selected' : '' }}>{{ $status_tagihan->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Ditagihkan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal_ditagihkan" id="tanggal_ditagihkan" value="{{ request('tanggal_ditagihkan') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Jatuh Tempo 1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="jatuh_tempo_1" id="jatuh_tempo_1" value="{{ request('jatuh_tempo_1') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Jatuh Tempo 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="jatuh_tempo_2" id="jatuh_tempo_2" value="{{ request('jatuh_tempo_2') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto pt-2">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tagihan Table</h4>
        </div>
        <div class="card-body">
            @if($tagihans->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Kode<br> Tagihan <span data-toggle="tooltip" title="Kode Tagihan"><i class="fas fa-question-circle"></i></span></th>
                            <th>Kode<br> Order</th>
                            <th>Kode<br> Cust</th>
                            <th>Customer</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Proyek</th>
                            <th>Tanggal<br> Ditagihkan</th>
                            <th>Jenis<br> Tagihan</th>
                            <th>Jatuh<br> Tempo 1</th>
                            <th>Jatuh<br> Tempo 2</th>
                            <th>Jumlah<br> Tagihan</th>
                            <th>Status<br> Tagihan</th>
                            <th>Keterangan</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tagihans as $tagihan)
                        <tr>
                            <td class="text-center">{{ $tagihan->tagihan_id }}</td>
                            <td class="text-center">{{ $tagihan->order->order_id }}</td>
                            <td class="text-center">{{ $tagihan->order->customer_id }}</td>
                            @if(!is_null($tagihan->order->customer))
                            <td>{{ $tagihan->order->customer->nama }}</td>
                            <td>{{ $tagihan->order->customer->perusahaan->badan_hukum ?? '-' }}</td>
                            <td>{{ $tagihan->order->customer->perusahaan->nama ?? '-' }}</td>
                            @else
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            @endif
                            <td>{{ $tagihan->order->nama_proyek }}</td>
                            <td>{{ $tagihan->tanggal_ditagihkan->format('d/m/Y') }}</td>
                            <td>{{ $tagihan->jenisTagihan->nama_tagihan }}</td>
                            <td>{{ $tagihan->jatuh_tempo_1->format('d/m/Y') }}</td>
                            <td>{{ $tagihan->jatuh_tempo_2->format('d/m/Y') }}</td>
                            <td><span class="badge badge-currency" style="background-color: #0080ff; color:white">Rp {{ number_format($tagihan->jumlah_tagihan,0 ,",","."). ',-' }}</span></td>
                            <td>{{ $tagihan->statusTagihan->nama_status }}</td>
                            <td>{{ $tagihan->keterangan }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.tagihans.edit', ['tagihan' => $tagihan->tagihan_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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

    .form-group {
        margin-bottom: 15px !important;
    }

    .badge-currency {
        border-radius: 5px !important;
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
        const fields = ['tagihan_id', 'order_id', 'customer_id', 'nama_customer', 'nama_perusahaan', 'jenis_tagihan_id', 'status_tagihan_id', 'tanggal_ditagihkan', 'jatuh_tempo_1', 'jatuh_tempo_2'];
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
        $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            autoUpdateInput: false,
        });
        $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").attr("placeholder", "");

        $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
        });

        $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
        });

        $("#filterForm").on("submit", function(e) {
            let tanggalDitagihkan = $("#tanggal_ditagihkan").val();
            let jatuhTempo1 = $("#jatuh_tempo_1").val();
            let jatuhTempo2 = $("#jatuh_tempo_2").val();
            let datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;

            if(tanggalDitagihkan){
                if (!datePattern.test(tanggalDitagihkan)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = tanggalDitagihkan.split(" - ");
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

            if(jatuhTempo1){
                if (!datePattern.test(jatuhTempo1)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = jatuhTempo1.split(" - ");
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

            if(jatuhTempo2){
                if (!datePattern.test(jatuhTempo2)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = jatuhTempo2.split(" - ");
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