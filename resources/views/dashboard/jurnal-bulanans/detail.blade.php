@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Journal Bulanan [ {{ $title }} ]</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.jurnal-bulanans.index') }}">Journal Bulanan</a></div>
        <div class="breadcrumb-item">Detail</div>
    </div>
</div>

<div class="section-body">
    <div class="section-title">
        <h5>Laporan Pendapatan dan Biaya Rental</h5>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header py-1">
                    <h4>Rental</h4>
                </div>
                <div class="card-body px-4 py-1">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Kode Posting</th>
                                    <th>Nama Posting</th>
                                    <th>Group Biaya</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($journals as $posting_biaya)
                                <tr>
                                    <td>{{ $title }}</td>
                                    <td>{{ $posting_biaya->posting_biaya_id }}</td>
                                    <td>{{ $posting_biaya->nama_posting }}</td>
                                    <td>{{ $posting_biaya->groupBiaya->nama_group }}</td>
                                    <td><span class="badge badge-currency" style="background-color:darkblue; color:white;">Rp {{ number_format($posting_biaya->total_debit,0,",",".").',-' }}</span></td>
                                    <td><span class="badge badge-currency" style="background-color:steelblue; color:white;">Rp {{ number_format($posting_biaya->total_kredit,0,",",".").',-' }}</span></td>
                                    <td>{{ $posting_biaya->count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-3">
                    <div class="row justify-content-end">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col-auto align-self-center pr-1"><h6>Jumlah</h6></div>
                        <div class="col pr-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="debit" id="debit" value="0" disabled>
                            </div>
                        </div>
                        <div class="col pr-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="debit" id="debit" value="0" disabled>
                            </div>
                        </div>
                        <div class="col pr-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="debit" id="debit" value="0" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
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

{{-- Spesific JS File --}}
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
@endpush
@endsection