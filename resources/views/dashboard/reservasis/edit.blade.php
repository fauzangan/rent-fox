@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Data Reservasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.reservasis.index') }}">Reservasi</a></div>
        <div class="breadcrumb-item">Edit Reservasi</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="section-title mt-0">
                Reservasi
            </div>
            <form action="{{ route('dashboard.reservasis.update', ['reservasi' => $reservasi->reservasi_id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Reservasi<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('tanggal_reservasi') is-invalid @enderror"
                                    id="tanggal_reservasi" name="tanggal_reservasi"
                                    value="{{ old('tanggal_reservasi', $reservasi->tanggal_reservasi->format('d/m/Y')) }}">
                                @error('tanggal_reservasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Reservasi<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control @error('status_reservasi_id') is-invalid @enderror"
                                name="status_reservasi_id" id="status_reservasi_id">
                                <option value="" disabled selected>Pilih Status Reservasi</option>
                                @foreach($status_reservasis as $status_reservasi)
                                <option value="{{ $status_reservasi->status_reservasi_id }}" {{
                                    old('status_reservasi_id', $reservasi->status_reservasi_id)==$status_reservasi->status_reservasi_id ? 'selected' : ''
                                    }}>{{$status_reservasi->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_reservasi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" value="{{ old('nama_customer', $reservasi->nama_customer) }}">
                        </div>
                        <div class="form-group">
                            <label>Telp Customer</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('telp_customer') is-invalid @enderror"
                                    name="telp_customer" id="telp_customer" value="{{ old('telp_customer', $reservasi->telp_customer) }}">
                                @error('telp_customer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Fax Customer</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-fax"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('fax_customer') is-invalid @enderror"
                                    name="fax_customer" id="fax_customer" value="{{ old('fax_customer', $reservasi->fax_customer) }}">
                                @error('fax_customer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Handphone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('handphone') is-invalid @enderror"
                                    name="handphone" id="handphone" value="{{ old('handphone', $reservasi->handphone) }}">
                                @error('handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Perusahaan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="row">
                                <div class="col-3">
                                    <select class="form-control" name="badan_hukum">
                                        <option value="CV." {{ old('badan_hukum', $reservasi->badan_hukum)=='CV.' ? 'selected' : '' }}>CV.
                                        </option>
                                        <option value="PT." {{ old('badan_hukum', $reservasi->badan_hukum)=='PT.' ? 'selected' : '' }}>PT.
                                        </option>
                                    </select>
                                </div>
                                <div class="col-9">
                                    <input type="text"
                                        class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        name="nama_perusahaan" value="{{ old('nama_perusahaan', $reservasi->nama_perusahaan) }}">
                                    @error('nama_perusahaan')
                                    <div class="invalid-feedback">
                                        Nama perusahaan perlu diisi
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Telp Perusahaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('telp_perusahaan') is-invalid @enderror"
                                    name="telp_perusahaan" id="telp_perusahaan" value="{{ old('telp_perusahaan', $reservasi->telp_perusahaan) }}">
                                @error('telp_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Fax Perusahaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-fax"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('fax_perusahaan') is-invalid @enderror"
                                    name="fax_perusahaan" id="fax_perusahaan" value="{{ old('fax_perusahaan', $reservasi->fax_perusahaan) }}">
                                @error('fax_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek dan Alamat Proyek</label>
                            <textarea type="text" class="form-control" name="proyek" id="proyek">{{ old('proyek', $reservasi->proyek) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan">{{ old('keterangan', $reservasi->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="section-title">Tambah Reservasi Item</div>
                @include('dashboard.reservasis.partials.edit-reservasi-item-form')
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data Reservasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
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
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/page/reservasi-edit.js') }}"></script>
<script src="{{ asset('assets/js/page/reservasi-edit-items.js') }}"></script>
@endpush
@endsection