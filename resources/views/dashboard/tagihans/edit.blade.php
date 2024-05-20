@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Tagihan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.tagihans.index') }}">Manajemen Tagihan</a></div>
        <div class="breadcrumb-item">Edit Tagihan</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Tagihan</h4>
        </div>
        <form action="{{ route('dashboard.tagihans.update', ['tagihan' => $tagihan->tagihan_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Kode Order</label>
                                    <input type="text" class="form-control" name="order_id" value="{{ old('order_id', $tagihan->order_id) }}" readonly>
                                    @error('order_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>Kode Customer</label>
                                    <input type="text" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror"
                                        id="customer_id" readonly value="{{ old('customer_id', $tagihan->order->customer_id) }}">
                                    @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror"
                                id="nama_customer" readonly value="{{ old('nama_customer', $tagihan->order->nama_customer) }}">
                            @error('nama_customer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <div class="row">
                                <div class="col-3 pr-1">
                                    <input type="text" name="badan_hukum" class="form-control @error('badan_hukum') is-invalid @enderror"
                                        id="badan_hukum" readonly value="{{ old('badan_hukum', $tagihan->order->badan_hukum) }}">
                                    @error('badan_hukum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-9 pl-1">
                                    <input type="text"
                                        name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        id="nama_perusahaan" readonly value="{{ old('nama_perusahaan', $tagihan->order->nama_perusahaan) }}">
                                    @error('nama_perusahaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <input type="text" name="nama_proyek" class="form-control @error('nama_proyek') is-invalid @enderror"
                                id="nama_proyek" readonly value="{{ old('nama_proyek', $tagihan->order->nama_proyek) }}">
                            @error('nama_proyek')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Tagihan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control select2 @error('jenis_tagihan_id') is-invalid @enderror"
                                name="jenis_tagihan_id" id="jenis_tagihan_id">
                                <option value="" disabled selected>Pilih Jenis Tagihan</option>
                                @foreach($jenis_tagihans as $jenis_tagihan)
                                <option value="{{ $jenis_tagihan->jenis_tagihan_id }}" {{ old('jenis_tagihan_id', $tagihan->jenis_tagihan_id)==$jenis_tagihan->jenis_tagihan_id ? 'selected' : '' }}>{{$jenis_tagihan->nama_tagihan }}</option>
                                @endforeach
                            </select>
                            @error('jenis_tagihan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Ditagihkan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text"
                                    class="form-control @error('tanggal_ditagihkan') is-invalid @enderror"
                                    id="tanggal_ditagihkan" name="tanggal_ditagihkan"
                                    value="{{ old('tanggal_ditagihkan', $tagihan->tanggal_ditagihkan->format('d/m/Y')) }}">
                                @error('tanggal_ditagihkan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jatuh Tempo 1<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('jatuh_tempo_1') is-invalid @enderror"
                                    id="jatuh_tempo_1" name="jatuh_tempo_1" value="{{ old('jatuh_tempo_1', $tagihan->jatuh_tempo_1->format('d/m/Y')) }}">
                                @error('jatuh_tempo_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jatuh Tempo 2<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('jatuh_tempo_2') is-invalid @enderror"
                                    id="jatuh_tempo_2" name="jatuh_tempo_2" value="{{ old('jatuh_tempo_2', $tagihan->jatuh_tempo_2->format('d/m/Y')) }}">
                                @error('jatuh_tempo_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Tagihan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select name="status_tagihan_id"
                                class="form-control select2 @error('status_tagihan_id') is-invalid @enderror"
                                id="status_tagihan_id">
                                <option value="" disabled selected>Pilih Status Tagihan</option>
                                @foreach($status_tagihans as $status_tagihan)
                                <option value="{{ $status_tagihan->status_tagihan_id }}" {{
                                    old('status_tagihan_id', $tagihan->status_tagihan_id)==$status_tagihan->status_tagihan_id ? 'selected' : '' }}
                                    >{{ $status_tagihan->nama_status }}</option>
                                @endforeach
                            </select>
                            @error('status_tagihan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jumlah Tagihan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" name="jumlah_tagihan" id="jumlah_tagihan"
                                    class="form-control @error('jumlah_tagihan') is-invalid @enderror"
                                    value="{{ old('jumlah_tagihan', $tagihan->jumlah_tagihan) }}">
                                @error('jumlah_tagihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" id="keterangan">{{ old('keterangan', $tagihan->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Apakah DP ?</label>
                            <select class="form-control @error('is_dp') is-invalid @enderror" name="is_dp" id="is_dp">
                                @if(isset($tagihan->total_dp))
                                <option value="0">Tidak</option>
                                <option value="1" selected>Ya</option>
                                @else
                                <option value="0" selected>Tidak</option>
                                <option value="1">Ya</option>
                                @endif
                            </select>
                            @error('is_dp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="dp-form-group" id="dp-form">
                            <div class="form-group">
                                <label>Total DP 1, 2, 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" name="total_dp" class="form-control @error('total_dp') is-invalid @enderror" value="{{ old('total_dp', $tagihan->total_dp)?? '' }}" id="total_dp">
                                    @error('total_dp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>DP 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" name="dp_1" id="dp_1"
                                        class="form-control @error('dp_1') is-invalid @enderror"
                                        value="{{ old('dp_1', $tagihan->dp_1)?? '' }}">
                                    @error('dp_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>DP 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" name="dp_2" id="dp_2"
                                        class="form-control @error('dp_2') is-invalid @enderror"
                                        value="{{ old('dp_2', $tagihan->dp_2)?? '' }}">
                                    @error('dp_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>DP 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" name="dp_3" id="dp_3"
                                        class="form-control @error('dp_3') is-invalid @enderror"
                                        value="{{ old('dp_3', $tagihan->dp_3)?? '' }}">
                                    @error('dp_3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Edit Tagihan</button>
            </div>
        </form>
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
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/page/tagihan-create.js') }}"></script>
@endpush
@endsection