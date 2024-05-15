@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Tagihan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
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
        <div class="card-header">
            <h4>Tagihan Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Tagihan"><i class="fas fa-question-circle"></i></span></th>
                            <th>Kode Order</th>
                            <th>Kode Cust</th>
                            <th>Customer</th>
                            <th>Hk.</th>
                            <th>Perusahaan</th>
                            <th>Proyek</th>
                            <th>Tgl Ditagihkan</th>
                            <th>Jenis Tagihan</th>
                            <th>Jatuh Tempo 1</th>
                            <th>Jatuh Tempo 2</th>
                            <th>Jumlah Tagihan</th>
                            <th>Status Tagihan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
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
@endpush
@endsection