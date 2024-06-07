@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Customer</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Customer</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Customer
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.customers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                Tambah Customer</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="{{ route('dashboard.customers.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Cust</label>
                            <input type="text" id="customer_id" name="customer_id" value="{{ request('customer_id') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ request('nama') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>No. Identitas</label>
                            <input type="text" id="nomor_identitas" name="nomor_identitas" value="{{ request('nomor_identitas') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>No. Handphone</label>
                            <input type="text" id="handphone" name="handphone" value="{{ request('handphone') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ request('nama_perusahaan') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Bonafidity</label>
                            <select class="form-control" id="bonafidity" name="bonafidity">
                                <option selected></option>
                                <option value="$$" {{ request('bonafidity') == '$$' ? 'selected' : '' }}>$$</option>
                                <option value="$" {{ request('bonafidity') == '$' ? 'selected' : '' }}>$</option>
                                <option value="del" {{ request('bonafidity') == 'del' ? 'selected' : '' }}>del</option>
                            </select>
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Status Cust</label>
                            <select class="form-control" id="status_customer_id" name="status_customer_id">
                                <option selected></option>
                                @foreach($status_customers as $status_customer)
                                <option value="{{ $status_customer->status_customer_id }}" {{ request('status_customer_id') == $status_customer->status_customer_id ? 'selected' : '' }}>{{ $status_customer->nama_status }}</option>
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
            <h4>Data Customer</h4>
        </div>
        <div class="card-body">
            @if($customers->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Customer"><i class="fas fa-question-circle"></i></span></th>
                            <th>Nama</th>
                            <th>Identitas</th>
                            <th>No. Identitas</th>
                            <th>No. Handphone</th>
                            <th>Status</th>
                            <th>Bonafidity</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customer->nama }}</td>
                            <td>{{ $customer->jenis_identitas }}</td>
                            <td>{{ $customer->nomor_identitas }}</td>
                            <td>{{ $customer->handphone }}</td>
                            <td>
                                @if($customer->status_customer_id == 1)
                                <div class="badge badge-success" style="color: black">{{ $customer->statusCustomer->nama_status }}</div>
                                @elseif($customer->status_customer_id == 2)
                                <div class="badge badge-warning" style="color: black">{{ $customer->statusCustomer->nama_status }}</div>
                                @else
                                <div class="badge badge-danger">{{ $customer->statusCustomer->nama_status }}</div>
                                @endif
                            </td>
                            <td>
                                @if($customer->bonafidity != 'del')
                                <div class="badge badge-success" style="color: black">{{ $customer->bonafidity }}</div>
                                @else
                                <div class="badge badge-danger">{{ $customer->bonafidity }}</div>
                                @endif
                            </td>
                            @if($customer->perusahaan != null)
                            <td>{{ $customer->perusahaan->badan_hukum }}</td>
                            <td>{{ $customer->perusahaan->nama }}</td>
                            @else
                            <td>-</td>
                            <td>-</td>
                            @endif
                            <td class="sticky-aksi-col">
                                <button class="btn btn-info" id="detail-button" data-id={{ $customer->customer_id}}>Detail</button>
                                <a href="{{ route('dashboard.customers.edit', ['customer' => $customer->customer_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('dashboard.customers.delete', ['customer' => $customer->customer_id]) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
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
                {{ $customers->links() }}
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

<!-- Spesific Page -->
<script src="{{ asset('assets/js/page/customer-index.js') }}"></script>
<script>
    $(document).ready(function() {
        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['customer_id', 'nama', 'nomor_identitas', 'handphone', 'nama_perusahaan', 'bonafidity', 'status_customer_id'];
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

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Detail Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Menampilkan detail customer -->
                <div class="row">
                    <div class="col">
                        <h5>Biodata Pribadi</h5>
                        <p><strong>Nama:</strong> <span id="customer-name"></span></p>
                        <p><strong>Jenis Identitas:</strong> <span id="customer-jenis-identitas"></span></p>
                        <p><strong>Identitas Berlaku:</strong> <span id="customer-identitas-berlaku"></span></p>
                        <p><strong>Nomor Identitas:</strong> <span id="customer-nomor-identitas"></span></p>
                        <p><strong>Jabatan:</strong> <span id="customer-jabatan"></span></p>
                        <p><strong>Alamat:</strong> <span id="customer-alamat"></span></p>
                        <p><strong>Kota:</strong> <span id="customer-kota"></span></p>
                        <p><strong>Provinsi:</strong> <span id="customer-provinsi"></span></p>
                        <p><strong>Telepon:</strong> <span id="customer-telp"></span></p>
                        <p><strong>Fax:</strong> <span id="customer-fax"></span></p>
                        <p><strong>Handphone:</strong> <span id="customer-handphone"></span></p>
                        <p><strong>Bonafidity:</strong> <span id="customer-bonafidity"></span></p>
                        <p><strong>Dibuat Pada:</strong> <span id="customer-created-at"></span></p>
                        <p><strong>Diupdate Pada:</strong> <span id="customer-updated-at"></span></p>
                    </div>
                    <div class="col">
                        <h5>Biodata Perusahaan</h5>
                        <p><strong>Perusahaan: </strong><span id="customer-perusahaan-nama"></span></p>
                        <p><strong>Provinsi: </strong><span id="customer-perusahaan-provinsi"></span></p>
                        <p><strong>Kota: </strong><span id="customer-perusahaan-kota"></span></p>
                        <p><strong>Alamat: </strong><span id="customer-perusahaan-alamat"></span></p>
                        <p><strong>Telp: </strong><span id="customer-perusahaan-telp"></span></p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->



@endsection