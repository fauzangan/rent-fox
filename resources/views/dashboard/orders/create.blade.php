@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Buat Data Order Baru</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}"></a>Manajemen Order</div>
        <div class="breadcrumb-item">Tambah Order</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="section-title mt-0">
                    Orders
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" class="form-control @error('tanggal_order') is-invalid @enderror" name="tanggal_order" id="tanggal_order" value="{{ old('tanggal_order') }}">
                            @error('tanggal_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <input type="text" class="form-control @error('tanggal_kirim') is-invalid @enderror" name="tanggal_kirim" id="tanggal_kirim" value="{{ old('tanggal_kirim') }}">
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
                                <option value="{{ $customer->customer_id }}" {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }} data-nama="{{ $customer->nama }}" data-identitas_customer="{{ $customer->nomor_identitas }}"
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
                            <input type="text" class="form-control @error('kirim_kepada') is-invalid @enderror" name="kirim_kepada" id="kirim_kepada" value="{{ old('kirim_kepada') }}">
                            @error('kirim_kepada')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Kirim</label>
                            <textarea type="text" class="form-control @error('alamat_kirim') is-invalid @enderror" name="alamat_kirim" id="alamat_kirim">{{ old('alamat_kirim') }}</textarea>
                            @error('alamat_kirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <textarea type="text" class="form-control @error('nama_proyek') is-invalid @enderror" name="nama_proyek" id="nama_proyek">{{ old('nama_proyek') }}</textarea>
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
                            <select class="form-control @error('status_transport') is-invalid @enderror" name="status_transport" id="status_transport">
                                <option value=1 {{ old('status_transport') == '1'? 'selected' : '' }}>Oleh ASR</option>
                                <option value=0 {{ old('status_transport') == '0'? 'selected' : '' }}>Mandiri</option>
                            </select>
                            @error('status_transport')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status Order</label>
                            <select class="form-control @error('status_order') is-invalid @enderror" name="status_order" id="status_order">
                                <option value=1 {{ old('status_order') == '1'? 'selected' : '' }}>Aktif</option>
                                <option value=0 {{ old('status_order') == '0'? 'selected' : '' }}>Non Aktif</option>
                            </select>
                            @error('status_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="section-title">Tambah Items Order</div>
                @include('dashboard.orders.partials.create-item-order-form')
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah Order Baru</button>
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
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/page/order-create.js') }}"></script>
<script src="{{ asset('assets/js/page/order-create-items.js') }}"></script>
@endpush

@endsection