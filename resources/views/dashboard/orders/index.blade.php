@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
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
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.customers.index') }}" method="GET">
                @csrf
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
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Cust</label>
                            <input type="text" id="nomor_identitas" name="nomor_identitas" value="{{ request('nomor_identitas') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" id="handphone" name="handphone" value="{{ request('handphone') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ request('nama_perusahaan') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Transport</label>
                            <select class="form-control" id="status_transport_id" name="status_transport_id">
                                <option selected></option>
                                @foreach($status_transports as $status_transport)
                                <option value="{{ $status_transport->status_transport_id }}" {{ request('status_transport_id') == $status_transport->status_transport_id ? 'selected' : '' }}>{{ $status_transport->nama_status }}</option>
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
                                <option value="{{ $status_order->status_order_id }}" {{ request('status_order_id') == $status_order->status_order_id ? 'selected' : '' }}>{{ $status_order->nama_status }}</option>
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
            <h4>Order Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Kode Order <span data-toggle="tooltip" title="Kode Order"><i
                                        class="fas fa-question-circle"></i></span></th>
                            <th>Tanggal Order</th>
                            <th>Tanggal Kirim</th>
                            <th>Kode Cust</th>
                            <th>Nama Cust</th>
                            <th>Alamat Cust</th>
                            <th>Kota Cust</th>
                            <th>Telp Cust</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Kirim Kepada</th>
                            <th>Proyek</th>
                            <th>Alamat Kirim</th>
                            <th>Keterangan</th>
                            <th>Transport</th>
                            <th>Status Order</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->tanggal_order->format('d/m/Y') }}</td>
                            <td>{{ $order->tanggal_kirim->format('d/m/Y') }}</td>
                            @if(!is_null($order->customer_id))
                            <td>{{ $order->customer_id }}</td>
                            <td>{{ $order->customer->nama }}</td>
                            <td>{{ $order->customer->alamat }}</td>
                            <td>{{ $order->customer->kota }}</td>
                            <td>{{ $order->customer->telp ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->badan_hukum ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->nama ?? '-' }}</td>
                            @else
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            <td><div class="badge badge-danger">dihapus</div></td>
                            @endif
                            <td>{{ $order->kirim_kepada }}</td>
                            <td>{{ $order->nama_proyek }}</td>
                            <td>{{ $order->alamat_kirim }}</td>
                            <td>{{ $order->keterangan }}</td>
                            <td>{{ $order->statusTransport->nama_status }}</td>
                            <td>
                                @if($order->statusOrder->status_order_id == 1)
                                <span class="badge badge-success" style="color: black">{{ $order->statusOrder->nama_status }}</span>
                                @elseif($order->statusOrder->status_order_id == 2)
                                <span class="badge badge-info" style="color: black">{{ $order->statusOrder->nama_status }}</span>
                                @elseif($order->statusOrder->status_order_id == 3)
                                <span class="badge badge-warning" style="color: black">{{ $order->statusOrder->nama_status }}</span>
                                @else
                                <span class="badge badge-danger">{{ $order->statusOrder->nama_status }}</span>
                                @endif
                            </td>
                            <td class="sticky-aksi-col">
                                <button class="btn btn-info" id="detail-button" data-id={{ $order->order_id
                                    }}>Detail</button>
                                <a href="{{ route('dashboard.orders.edit', ['order' => $order->order_id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <a href="{{ route('dashboard.orders.delete', ['order' => $order->order_id]) }}"
                                    class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
<script>
    $(document).ready(function() {
        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['item_id', 'nama_item', 'category_item_id'];
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
    });
</script>
@endpush
@endsection