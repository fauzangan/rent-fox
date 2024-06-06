@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Data Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Manajemen Order</a></div>
        <div class="breadcrumb-item">Edit Data Order</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.orders.update', ['order' => $order]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="section-title mt-0">
                    Orders
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" class="form-control @error('tanggal_order') is-invalid @enderror" name="tanggal_order" id="tanggal_order" value="{{ old('tanggal_order', $order->tanggal_order->format('d/m/Y')) }}">
                            @error('tanggal_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <input type="text" class="form-control @error('tanggal_kirim') is-invalid @enderror" name="tanggal_kirim" id="tanggal_kirim" value="{{ old('tanggal_kirim', $order->tanggal_kirim->format('d/m/Y')) }}">
                            @error('tanggal_kirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <select class="form-control select2 @error('customer_id') is-invalid @enderror" id="customer_select" name="customer_id">
                                <option selected disabled>Pilih Customer</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->customer_id }}" {{ old('customer_id', $order->customer_id) == $customer->customer_id ? 'selected' : '' }} data-nama="{{ $customer->nama }}" data-identitas_customer="{{ $customer->nomor_identitas }}"
                                    data-alamat="{{
                                    $customer->alamat }}" data-kota="{{ $customer->kota }}" data-telp="{{ $customer->telp
                                    }}" data-fax="{{ $customer->fax }}" data-handphone="{{ $customer->handphone }}"
                                    data-badan_hukum="{{ $customer->perusahaan->badan_hukum ?? '' }}"
                                    data-nama_perusahaan="{{
                                    $customer->perusahaan->nama?? '' }}" data-alamat_perusahaan="{{
                                    $customer->perusahaan->alamat?? '' }}" data-kota_perusahaan="{{
                                    $customer->perusahaan->kota?? ''
                                    }}" data-telp_perusahaan="{{ $customer->perusahaan->telp?? '' }}"
                                    data-fax_perusahaan="{{
                                    $customer->perusahaan->fax?? '' }}">Kode: {{ $customer->customer_id }} | {{
                                    $customer->nama
                                    }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control @error('nama_customer') is-invalid @enderror" name="nama_customer" id="nama_customer" value="{{ old('nama_customer') }}" readonly>
                            @error('nama_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No Identitas</label>
                            <input type="text" class="form-control @error('identitas_customer') is-invalid @enderror" name="identitas_customer" id="identitas_customer" value="{{ old('identitas_customer') }}" readonly>
                            @error('identitas_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Customer</label>
                            <textarea type="text" class="form-control @error('alamat_customer') is-invalid @enderror" name="alamat_customer" id="alamat_customer" value="{{ old('alamat_customer') }}" readonly></textarea>
                            @error('alamat_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kota Customer</label>
                            <input type="text" class="form-control @error('kota_customer') is-invalid @enderror" name="kota_customer" id="kota_customer" value="{{ old('kota_customer') }}" readonly>
                            @error('kota_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>         
                        <div class="form-group">
                            <label>Telp Customer</label>
                            <input type="text" class="form-control @error('telp_customer') is-invalid @enderror" name="telp_customer" id="telp_customer" value="{{ old('telp_customer') }}" readonly>
                            @error('telp_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fax Customer</label>
                            <input type="text" class="form-control @error('fax_customer') is-invalid @enderror" name="fax_customer" id="fax_customer" value="{{ old('fax_customer') }}" readonly>
                            @error('fax_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Handphone Customer</label>
                            <input type="text" class="form-control @error('handphone') is-invalid @enderror" name="handphone" id="handphone" value="{{ old('handphone') }}" readonly>
                            @error('handphone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <div class="row">
                                <div class="col-3 pr-1">
                                    <input type="text" class="form-control @error('badan_hukum') is-invalid @enderror" name="badan_hukum" id="badan_hukum" value="{{ old('badan_hukum') }}" readonly>
                                    @error('badan_hukum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-9 pl-1">
                                    <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}" readonly>
                                    @error('nama_perusahaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Perusahaan</label>
                            <textarea type="text" class="form-control @error('alamat_perusahaan') is-invalid @enderror" name="alamat_perusahaan" id="alamat_perusahaan" value="{{ old('alamat_perusahaan') }}" readonly></textarea>
                            @error('alamat_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kota Perusahaan</label>
                            <input type="text" class="form-control @error('kota_perusahaan') is-invalid @enderror" name="kota_perusahaan" id="kota_perusahaan" value="{{ old('kota_perusahaan') }}" readonly>
                            @error('kota_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telp Perusahaan</label>
                            <input type="text" class="form-control @error('telp_perusahaan') is-invalid @enderror" name="telp_perusahaan" id="telp_perusahaan" value="{{ old('telp_perusahaan') }}" readonly>
                            @error('telp_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fax Perusahaan</label>
                            <input type="text" class="form-control @error('fax_perusahaan') is-invalid @enderror" name="fax_perusahaan" id="fax_perusahaan" value="{{ old('fax_perusahaan') }}" readonly>
                            @error('fax_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kirim Kepada</label>
                            <input type="text" class="form-control @error('kirim_kepada') is-invalid @enderror" name="kirim_kepada" id="kirim_kepada" value="{{ old('kirim_kepada', $order->kirim_kepada) }}">
                            @error('kirim_kepada')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Kirim</label>
                            <textarea type="text" class="form-control @error('alamat_kirim') is-invalid @enderror" name="alamat_kirim" id="alamat_kirim">{{ old('alamat_kirim', $order->alamat_kirim) }}</textarea>
                            @error('alamat_kirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <textarea type="text" class="form-control @error('nama_proyek') is-invalid @enderror" name="nama_proyek" id="nama_proyek">{{ old('nama_proyek', $order->nama_proyek) }}</textarea>
                            @error('nama_proyek')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Status Transport</label>
                            <select class="form-control @error('status_transport_id') is-invalid @enderror" name="status_transport_id" id="status_transport_id">
                                @foreach($status_transports as $status_transport)
                                <option value="{{ $status_transport->status_transport_id }}" {{ old('status_transport_id', $order->status_transport_id) == $status_transport->status_transport_id ? 'selected' : '' }}>{{ $status_transport->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_transport_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Order</label>
                            <select class="form-control @error('status_order_id') is-invalid @enderror" name="status_order_id" id="status_order_id">
                                @foreach($status_orders as $status_order)
                                <option value="{{ $status_order->status_order_id }}" {{ old('status_order_id', $order->status_order_id) == $status_order->status_order_id ? 'selected' : '' }}>{{ $status_order->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_order_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{{ old('keterangan', $order->keterangan ?? '') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <hr class="bg-primary pb-1">
                        <div class="form-group">
                            <label>Memoir</label>
                            <textarea type="text" class="form-control @error('memo') is-invalid @enderror" name="memo" id="memo">{{ old('memo', $order->memo ?? '') }}</textarea>
                            @error('memo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="section-title">Edit Items Order</div>
                @include('dashboard.orders.partials.edit-item-order-form')
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
<style>
    .form-group {
        margin-bottom: 15px !important;
    }
</style>
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/page/order-edit.js') }}"></script>
<script src="{{ asset('assets/js/page/order-edit-items.js') }}"></script>
@endpush

@endsection