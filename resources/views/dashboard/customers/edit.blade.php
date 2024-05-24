@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Edit Data Customer</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.customers.index') }}">Manajemen Customer</a></div>
        <div class="breadcrumb-item">Edit Customer</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Edit Biodata Customer (Id : {{ $customer->customer_id }})</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.customers.update', $customer) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nama<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama', $customer->nama) }}">
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
                                <option value="KTP" {{ old('jenis_identitas', $customer->jenis_identitas) == 'KTP' ?
                                    'selected' : '' }}>KTP</option>
                                <option value="SIM" {{ old('jenis_identitas', $customer->jenis_identitas) == 'SIM' ?
                                    'selected' : '' }}>SIM</option>
                            </select>
                        </div>
                        <div class="form-group" id="identitas_berlaku_form">
                            <label>ID Berlaku Sampai Tanggal<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('identitas_berlaku') is-invalid @enderror"
                                name="identitas_berlaku" placeholder="HH/BB/TTTT" id="identitas_berlaku"
                                @if($customer->identitas_berlaku != null)
                                value="{{ old('identitas_berlaku', $customer->identitas_berlaku->format('d/m/Y')) }}"
                                @else
                                value="{{ old('identitas_berlaku')}}"
                                @endif
                                >
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
                                name="nomor_identitas" id="nomor_identitas"
                                value="{{ old('nomor_identitas', $customer->nomor_identitas) }}">
                            @error('nomor_identitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" value="{{ old('jabatan', $customer->jabatan) }}">
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
                                name="alamat">{{ old('alamat', $customer->alamat) }}</textarea>
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
                                value="{{ old('kota', $customer->kota) }}">
                            @error('kota')
                            <div class="invalid-feedback">
                                Kota perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provinsi<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                name="provinsi" value="{{ old('kota', $customer->provinsi) }}">
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
                                    id="telp" value="{{ old('telp', $customer->telp) }}">
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
                                    id="fax" value="{{ old('fax', $customer->fax) }}">
                                @error('fax')
                                <div class="invalid-feedback">
                                    Fax perlu diisi
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Handphone<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-mobile"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('handphone') is-invalid @enderror"
                                    name="handphone" id="handphones"
                                    value="{{ old('handphone', $customer->handphone) }}">
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
                                name="keterangan">{{ old('keterangan', $customer->keterangan) }}</textarea>
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
                                <option value="$" {{ old('bonafidity', $customer->bonafidity) == '$' ? 'selected' : ''
                                    }}>$</option>
                                <option value="$$" {{ old('bonafidity', $customer->bonafidity) == '$$' ? 'selected' : ''
                                    }}>$$</option>
                                <option value="del" {{ old('bonafidity', $customer->bonafidity) == 'del' ? 'selected' :
                                    '' }}>del</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Data<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="status_customer_id">
                                @foreach($status_customers as $status_customer)
                                <option value="{{ $status_customer->status_customer_id }}" {{ old('status_customer_id', $customer->status_customer_id) == $status_customer->status_customer_id ? 'selected' : '' }}>{{ $status_customer->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Surat Kuasa</label>
                            <select class="form-control" name="surat_kuasa">
                                <option value=0 {{ old('surat_kuasa', $customer->surat_kuasa) == 0 ? 'selected' : ''
                                    }}>Tidak Ada</option>
                                <option value=1 {{ old('surat_kuasa', $customer->surat_kuasa) == 1 ? 'selected' : ''
                                    }}>Ada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Mewakili<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="is_perusahaan" id="is_perusahaan" disabled="true">
                                <option value=0 @if($customer->perusahaan_id == null) selected @endif >Diri Sendiri
                                </option>
                                <option value=1 @if($customer->perusahaan_id != null) selected @endif>Perusahaan
                                </option>
                            </select>
                        </div>
                        <div class="company-form-group" id="company-form">
                            <div class="form-group">
                                <label>Nama Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-control" name="badan_hukum">
                                            <option value="CV.">CV.</option>
                                            <option value="PT.">PT.</option>
                                        </select>  
                                    </div>
                                    <div class="col-9">
                                        <input type="text"
                                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                            name="nama_perusahaan" value="{{ old('nama_perusahaan', $customer->perusahaan->nama ?? null) }}">
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
                                    name="alamat_perusahaan">{{ old('alamat_perusahaan', $customer->perusahaan->alamat ?? null) }}</textarea>
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
                                    name="kota_perusahaan" value="{{ old('kota_perusahaan', $customer->perusahaan->kota ?? null)}}">
                                @error('kota_perusahaan')
                                <div class="invalid-feedback">
                                    Kota perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Provinsi Perusahaan<span class="text-danger" data-toggle="tooltip"
                                        title="Wajib Diisi!">*</span></label>
                                <input type="text"
                                    class="form-control @error('provinsi_perusahaan') is-invalid @enderror"
                                    name="provinsi_perusahaan" value="{{ old('provinsi_perusahaan', $customer->perusahaan->provinsi ?? null) }}">
                                @error('provinsi_perusahaan')
                                <div class="invalid-feedback">
                                    Kota perusahaan perlu diisi
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
                                        value="{{ old('telp_perusahaan', $customer->perusahaan->telp ?? null) }}">
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
                                        name="fax_perusahaan" id="fax" value="{{ old('fax_perusahaan', $customer->perusahaan->fax ?? null) }}">
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
                    <button class="btn btn-primary" type="submit">Edit Data Customer</button>
                </div>
            </form>
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


<!-- Page Specific JS File -->
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/page/customer-edit.js') }}"></script>

@endpush
@endsection