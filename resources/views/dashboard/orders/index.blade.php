@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Order</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Order
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Order</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-filter"
                    id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.orders.index') }}" method="GET">
                <div class="row align-items-center">
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
                            <input type="text" id="nama" name="nama" value="{{ request('nama') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <input type="text" id="perusahaan" name="perusahaan" value="{{ request('perusahaan') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Transport</label>
                            <select class="form-control" id="status_transport_id" name="status_transport_id">
                                <option selected></option>
                                @foreach($status_transports as $status_transport)
                                <option value="{{ $status_transport->status_transport_id }}" {{
                                    request('status_transport_id')==$status_transport->status_transport_id ? 'selected'
                                    : '' }}>{{ $status_transport->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Status Order</label>
                            <select class="form-control" id="status_order_id" name="status_order_id">
                                <option selected></option>
                                @foreach($status_orders as $status_order)
                                <option value="{{ $status_order->status_order_id }}" {{
                                    request('status_order_id')==$status_order->status_order_id ? 'selected' : '' }}>{{
                                    $status_order->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal_order" id="tanggal_order"
                                    value="{{ request('tanggal_order') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal_kirim" id="tanggal_kirim" value="{{ request('tanggal_kirim') }}" class="form-control">
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
            <h4>Order Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                @if($orders->count() == 0)
                <h4 class="text-center">Tidak ada Data</h4>
                @else
                <table class="table table-bordered table-hover table-md">
                    <thead>
                        <tr>
                            <th class="text-center">Kode<br>Order</th>
                            <th>Tanggal<br> Order</th>
                            <th>Tanggal<br> Kirim</th>
                            <th class="text-center">Kode<br> Cust</th>
                            <th>Nama<br> Customer</th>
                            <th>Alamat<br> Customer</th>
                            <th>Kota<br> Customer</th>
                            <th>No. Handphone<br> Customer</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Kirim<br> Kepada</th>
                            <th>Proyek</th>
                            <th>Alamat<br> Kirim</th>
                            <th>Keterangan</th>
                            <th>Transport</th>
                            <th>Status<br> Order</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->order_id }}</td>
                            <td>{{ $order->tanggal_order->format('d/m/Y') }}</td>
                            <td>{{ $order->tanggal_kirim->format('d/m/Y') }}</td>
                            @if(!is_null($order->customer_id))
                            <td class="text-center">{{ $order->customer_id }}</td>
                            <td>{{ $order->customer->nama }}</td>
                            <td>{{ $order->customer->alamat }}</td>
                            <td>{{ $order->customer->kota }}</td>
                            <td>{{ $order->customer->handphone ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->badan_hukum ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->nama ?? '-' }}</td>
                            @else
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            <td>
                                <div class="badge badge-danger">dihapus</div>
                            </td>
                            @endif
                            <td>{{ $order->kirim_kepada }}</td>
                            <td>{{ $order->nama_proyek }}</td>
                            <td>{{ $order->alamat_kirim }}</td>
                            <td>{{ $order->keterangan ?? '-' }}</td>
                            <td>{{ $order->statusTransport->nama_status }}</td>
                            <td>
                                @if($order->statusOrder->status_order_id == 1)
                                <span class="badge badge-success" style="color: black">{{
                                    $order->statusOrder->nama_status }}</span>
                                @elseif($order->statusOrder->status_order_id == 2)
                                <span class="badge badge-info" style="color: black">{{ $order->statusOrder->nama_status
                                    }}</span>
                                @elseif($order->statusOrder->status_order_id == 3)
                                <span class="badge badge-warning" style="color: black">{{
                                    $order->statusOrder->nama_status }}</span>
                                @else
                                <span class="badge badge-danger">{{ $order->statusOrder->nama_status }}</span>
                                @endif
                            </td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.orders.detail', ['order' => $order->order_id]) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('dashboard.orders.edit', ['order' => $order->order_id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <a href="#"
                                    class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $orders->links() }}
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

        $('button[type="reset"]').on('click', function(event) {
            event.preventDefault(); // Mencegah form mereset secara default
            window.location.href = "{{ route('dashboard.orders.index') }}"; // Redirect ke halaman index
        });

        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['order_id', 'customer_id', 'nama', 'perusahaan', 'status_transport_id', 'status_order_id', 'tanggal_order', 'tanggal_kirim'];
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
        $("#tanggal_order, #tanggal_kirim").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            autoUpdateInput: false,
        });
        $("#tanggal_order, #tanggal_kirim").attr("placeholder", "");

        $("#tanggal_order, #tanggal_kirim").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
        });

        $("#tanggal_order, #tanggal_kirim").on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
        });

        $("#filterForm").on("submit", function(e) {
            let tanggal_order = $("#tanggal_order").val();
            let tanggal_kirim = $("#tanggal_kirim").val();
            let datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;

            if(tanggal_order){
                if (!datePattern.test(tanggal_order)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = tanggal_order.split(" - ");
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
            if(tanggal_kirim){
                if (!datePattern.test(tanggal_kirim)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = tanggal_kirim.split(" - ");
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