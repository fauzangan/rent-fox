@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Data Customer</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.customers.index') }}">Manajemen Customer</a></div>
        <div class="breadcrumb-item">Tambah Customer</div>
    </div>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Biodata Customer</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.customers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nama<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                Nama perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Identitas<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="jenis_identitas" id="jenis_identitas">
                                <option value="KTP" {{ old('jenis_identitas')=='KTP' ? 'selected' : '' }}>KTP</option>
                                <option value="SIM" {{ old('jenis_identitas')=='SIM' ? 'selected' : '' }}>SIM</option>
                            </select>
                        </div>
                        <div class="form-group" id="identitas_berlaku_form">
                            <label>ID Berlaku Sampai Tanggal<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('identitas_berlaku') is-invalid @enderror"
                                name="identitas_berlaku" placeholder="HH/BB/TTTT" id="identitas_berlaku"
                                value="{{ old('identitas_berlaku') }}">
                            @error('identitas_berlaku')
                            <div class="invalid-feedback">
                                Identitas Berlaku Sampai, perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No. Identitas<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror"
                                name="nomor_identitas" id="nomor_identitas" value="{{ old('nomor_identitas') }}">
                            @error('nomor_identitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" value="{{ old('jabatan') }}">
                            @error('jabatan')
                            <div class="invalid-feedback">
                                Jabatan perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <textarea type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat">{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                Alamat perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kota<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota"
                                value="{{ old('kota') }}">
                            @error('kota')
                            <div class="invalid-feedback">
                                Kota perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provinsi<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi"
                                id="provinsi">
                                <option disabled selected>Pilih Provinsi</option>
                                @foreach($provinsis as $provinsi)
                                <option value="{{ $provinsi->nama }}" {{ old('provinsi')==$provinsi->nama ? 'selected' :
                                    '' }}>{{ $provinsi->nama }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                            <div class="invalid-feedback">
                                Provinsi perlu diisi
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Telephone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp"
                                    id="telp" value="{{ old('telp') }}">
                                @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fax</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-fax"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('fax') is-invalid @enderror" name="fax"
                                    id="fax" value="{{ old('fax') }}">
                                @error('fax')
                                <div class="invalid-feedback">
                                    Fax perlu diisi
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Handphone<span class="text-danger" data-toggle="tooltip" title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('handphone') is-invalid @enderror" name="handphone" id="handphones" value="{{ old('handphone') }}">
                                @error('handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                Keterangan perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bonafidity<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="bonafidity">
                                <option value="$">$</option>
                                <option value="$$">$$</option>
                                <option value="del">del</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Data<span class="text-danger" data-toggle="tooltip" title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="status_customer_id">
                                @foreach($status_customers as $status_customer)
                                <option value="{{ $status_customer->status_customer_id }}" {{ old('status_customer_id') == $status_customer->status_customer_id ? 'selected' : '' }}>{{ $status_customer->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Surat Kuasa</label>
                            <select class="form-control" name="surat_kuasa">
                                <option value=0>Tidak Ada</option>
                                <option value=1>Ada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Mewakili<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="is_perusahaan" id="is_perusahaan">
                                <option value=0 {{ old('is_perusahaan')==0 ? 'selected' : '' }}>Diri Sendiri</option>
                                <option value=1 {{ old('is_perusahaan')==1 ? 'selected' : '' }}>Perusahaan</option>
                            </select>
                        </div>
                        <div class="company-form-group" id="company-form">
                            <div class="form-group">
                                <label>Nama Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-control" name="badan_hukum">
                                            <option value="CV." {{ old('badan_hukum')=='CV.' ? 'selected' : '' }}>CV.
                                            </option>
                                            <option value="PT." {{ old('badan_hukum')=='PT.' ? 'selected' : '' }}>PT.
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-9">
                                        <input type="text"
                                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                            name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                                        @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            Nama perusahaan perlu diisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <textarea type="text"
                                    class="form-control @error('alamat_perusahaan') is-invalid @enderror"
                                    name="alamat_perusahaan">{{ old('alamat_perusahaan') }}</textarea>
                                @error('alamat_perusahaan')
                                <div class="invalid-feedback">
                                    Alamat perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kota Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <input type="text" class="form-control @error('kota_perusahaan') is-invalid @enderror"
                                    name="kota_perusahaan" value="{{ old('kota_perusahaan') }}">
                                @error('kota_perusahaan')
                                <div class="invalid-feedback">
                                    Kota perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Provinsi Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <select class="form-control @error('provinsi_perusahaan') is-invalid @enderror"
                                    name="provinsi_perusahaan" id="provinsi_perusahaan">
                                    <option disabled selected>Pilih Provinsi</option>
                                    @foreach($provinsis as $provinsi)
                                    <option value="{{ $provinsi->nama }}" {{ old('provinsi_perusahaan')==$provinsi->nama
                                        ? 'selected' : '' }}>{{ $provinsi->nama }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi_perusahaan')
                                <div class="invalid-feedback">
                                    Provinsi perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Telephone Perusahaan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control @error('telp_perusahaan') is-invalid @enderror"
                                        name="telp_perusahaan" id="telp_perusahaan"
                                        value="{{ old('telp_perusahaan') }}">
                                    @error('telp_perusahaan')
                                    <div class="invalid-feedback">
                                        Telp perusahaan perlu diisi
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fax Perusahaan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-fax"></i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control @error('fax_perusahaan') is-invalid @enderror"
                                        name="fax_perusahaan" id="fax" value="{{ old('fax_perusahaan') }}">
                                    @error('fax_perusahaan')
                                    <div class="invalid-feedback">
                                        Fax perusahaan perlu diisi
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" type="submit">Tambah Data Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
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

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/customer-create.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@endsection