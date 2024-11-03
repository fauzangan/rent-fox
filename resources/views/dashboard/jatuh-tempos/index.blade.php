@extends('dashboard.layouts.main')
@section('content')

<div class="section-header">
    <h1>Jatuh Tempo Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Jatuh Tempo Order</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        {{-- <div class="card-header">
            <h4>Jatuh Tempo Order</h4>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                @if($orders->count() == 0)
                <h4 class="text-center">Tidak ada Data</h4>
                @else
                <table class="table table-bordered table-hover table-md">
                    <thead>
                        <tr>
                            <th style="text-center">Kode Cust.</th>
                            <th>Tanggal<br> Kirim</th>
                            <th>Bulan<br> Ke</th>
                            <th>Jatuh<br> Tempo Ini</th>
                            <th>Kode<br> Order</th>
                            <th>Nama<br> Cust.</th>
                            <th>Perusahaan</th>
                            <th>Nama Proyek</th>
                            <th>Alamat Kirim</th>
                            <th>Telp. Cust</th>
                            <th>Fax Cust</th>
                            <th>HP</th>
                            <th>Telp. Perush</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->customer_id }}</td>
                            <td>{{ $order->tanggal_kirim->format('d/m/Y') }}</td>
                            <th>{{ $order->bulan_ke }}</th>
                            <td>{{ $order->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $order->order_id }}</td>
                            <td>{{ $order->customer->nama }}</td>
                            <td>{{ $order->customer->perusahaan->badan_hukum ?? '-' }} {{ $order->customer->perusahaan->nama ?? '' }}</td>
                            <td>{{ $order->nama_proyek ?? '-' }}</td>
                            <td>{{ $order->alamat_kirim }}</td>
                            <td>{{ $order->customer->telp ?? '-' }}</td>
                            <td>{{ $order->customer->fax ?? '-' }}</td>
                            <td>{{ $order->customer->handphone ?? '-' }}</td>
                            <td>{{ $order->customer->perusahaan->telp ?? '-' }}</td>
                            <td>
                                @if($order->statusOrder->status_order_id == 1)
                                <span class="badge badge-success" style="color: black">{{
                                    $order->statusOrder->nama_status }}</span>     
                                @else
                                <span class="badge badge-danger">{{ $order->statusOrder->nama_status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="text-right mt-2">
                <nav class="d-inline-block">
                    {{ $orders->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Form Sticky Section -->
<div class="card fixed-bottom bg-light">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form>
                    <div class="form-group row">
                        <label for="kodeOrder" class="col-form-label col-6 font-weight-bold text-center bg-primary text-white rounded">KODE ORDER</label>
                        <div class="col-6">
                            {{-- <select class="form-control" id="kodeOrder">
                                <option value="123">123</option>
                                <option value="124">124</option>
                            </select> --}}
                            <select class="form-control select2 @error('order_id') is-invalid @enderror"
                            name="order_id" id="order_id">
                            <option disabled selected>Pilih Kode Order</option>
                            @foreach($orders as $order)
                            <option value="{{ $order->order_id }}" {{ old('order_id')==$order->order_id ?
                                'selected' : '' }}>{{
                                $order->order_id }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-6 font-weight-bold text-center bg-warning text-dark rounded">CLAIM RINGAN</label>
                        <div class="col-6">
                            <input type="text" class="form-control text-center bg-white" value="Rp9.000" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-6 font-weight-bold text-center bg-warning text-dark rounded">CLAIM BERAT%</label>
                        <div class="col-6">
                            <input type="text" class="form-control text-center bg-white" value="90" disabled readonly>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Jatuh Tempo Section -->
            <div class="col">
                <div class="form-group row">
                    <label class="col-form-label col-6 font-weight-bold text-center bg-primary text-white rounded">Jatuh Tempo Lalu</label>
                    <div class="col-6">
                        <input type="text" class="form-control text-center bg-white" value="05/05/2024" disabled readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-6 font-weight-bold text-center bg-primary text-white rounded">Jatuh Tempo Ini</label>
                    <div class="col-6">
                        <input type="text" class="form-control text-center bg-white" value="04/06/2024" disabled readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-6 font-weight-bold text-center bg-primary text-white rounded">Jatuh Tempo Perpanjang</label>
                    <div class="col-6">
                        <input type="text" class="form-control text-center bg-white" value="04/07/2024" disabled readonly>
                    </div>
                </div>
            </div>

            <!-- Final Section dengan Tombol -->
            <div class="col">
                <div class="form-group row">
                    <label class="col-form-label col-6 font-weight-bold text-center bg-info text-white rounded">Tanggal Final</label>
                    <div class="col-6">
                        <input type="date" class="form-control" id="tanggalFinal" value="2024-06-22">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6 mb-2">
                        <button type="button" class="btn btn-md btn-success btn-block">Tagihan Perpanjang</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button type="button" class="btn btn-md btn-success btn-block">Tagihan Periode Final</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-md btn-primary btn-block"><i class="fa fa-minus"></i> MIN</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-md btn-primary btn-block"><i class="fa fa-plus"></i> PLUS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush

@push('scripts')
{{-- JS Libraries --}}
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
@endpush
@endsection