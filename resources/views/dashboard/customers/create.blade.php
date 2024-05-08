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
                            <label>Jenis Identitas</label>
                            <select class="form-control" name="jenis_identitas" id="jenis_identitas">
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                        <div class="form-group" id="identitas_berlaku_form">
                            <label>ID Berlaku Sampai Tanggal</label>
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
                            <label>No. Identitas</label>
                            <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror"
                                name="nomor_identitas" id="nomor_identitas" value="{{ old('nomor_identitas') }}">
                            @error('nomor_identitas')
                            <div class="invalid-feedback">
                                Identitas Berlaku Sampai, perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan">
                            @error('jabatan')
                            <div class="invalid-feedback">
                                Jabatan perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat"></textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                Alamat perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota">
                            @error('kota')
                            <div class="invalid-feedback">
                                Kota perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                name="provinsi">
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
                                    id="telp">
                                @error('telp')
                                <div class="invalid-feedback">
                                    Telp perlu diisi
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
                                    id="fax">
                                @error('fax')
                                <div class="invalid-feedback">
                                    Fax perlu diisi
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
                                    name="handphone" id="handphones">
                                @error('handphone')
                                <div class="invalid-feedback">
                                    Nomor Handphone perlu diisi
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan"></textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                Keterangan perlu diisi
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bonafidity</label>
                            <select class="form-control" name="bonafidity">
                                <option value="$">$</option>
                                <option value="$$">$$</option>
                                <option value="del">del</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Data</label>
                            <select class="form-control" name="bit_active">
                                <option value=1>Aktif</option>
                                <option value=0>Tidak Aktif</option>
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
                            <label>Mewakili</label>
                            <select class="form-control" name="is_perusahaan" id="is_perusahaan">
                                <option value=0>Diri Sendiri</option>
                                <option value=1>Perusahaan</option>
                            </select>
                        </div>
                        <div class="company-form-group" id="company-form">
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-control" name="badan_hukum_id">
                                            @foreach($badan_hukums as $badan_hukum)
                                            <option value={{ $badan_hukum->badan_hukum_id }}>{{ $badan_hukum->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-9">
                                        <input type="text"
                                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                            name="nama_perusahaan">
                                        @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            Nama perusahaan perlu diisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat Perusahaan</label>
                                <textarea type="text"
                                    class="form-control @error('alamat_perusahaan') is-invalid @enderror"
                                    name="alamat_perusahaan"></textarea>
                                @error('alamat_perusahaan')
                                <div class="invalid-feedback">
                                    Alamat perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kota Perusahaan</label>
                                <input type="text" class="form-control @error('kota_perusahaan') is-invalid @enderror"
                                    name="kota_perusahaan">
                                @error('kota_perusahaan')
                                <div class="invalid-feedback">
                                    Kota perusahaan perlu diisi
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Provinsi Perusahaan</label>
                                <input type="text"
                                    class="form-control @error('provinsi_perusahaan') is-invalid @enderror"
                                    name="provinsi_perusahaan">
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
                                        name="telp_perusahaan" id="telp_perusahaan">
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
                                    <input type="text" class="form-control @error('fax_perusahaan') is-invalid @enderror" name="fax_perusahaan" id="fax">
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

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
<script>
    new Cleave('#identitas_berlaku', {
        date: true,
        datePattern: ['d', 'm', 'Y']
    });

    new Cleave('#handphones', {
        phone: true,
        phoneRegionCode: 'ID'
    });

    new Cleave('#telp', {
        phone: true,
        phoneRegionCode: 'ID'
    });

    new Cleave('#telp_perusahaan', {
        phone: true,
        phoneRegionCode: 'ID'
    });
</script>
<!-- Custom JavaScript -->
<script>
    $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip(); 
    // Fungsi untuk menghapus nilai dari elemen input dan textarea
    function clearCompanyForm() {
        $('#company-form').find('input, textarea').val('');
    }
    function clearIdBerlakuForm(){
        $('#identitas_berlaku_form').find('input').val('');
    }

    // Fungsi untuk mengatur status aktif dari elemen input dan textarea
    function setCompanyFormEnabled(enabled) {
        $('#company-form').find('input, select, textarea').prop('disabled', !enabled);
    }
    function setIdBerlakuFormEnabled(enabled) {
        $('#identitas_berlaku_form').find('input').prop('disabled', !enabled);
    }

    // Mendengarkan perubahan pada elemen select "is_perusahaan"
    $('#is_perusahaan').on('change', function() {
        var selectedValue = $(this).val();

        // Menampilkan atau menyembunyikan form perusahaan berdasarkan nilai yang dipilih
        if (selectedValue == '1') {
            // Jika opsi "Perusahaan" dipilih, tampilkan form perusahaan dan aktifkan input
            $('#company-form').slideDown();
            setCompanyFormEnabled(true);
        } else {
            // Jika opsi "Diri Sendiri" dipilih, sembunyikan form perusahaan, nonaktifkan input, dan hapus nilai input
            $('#company-form').slideUp();
            setCompanyFormEnabled(false);
            clearCompanyForm();
        }
    });
    // Trigger change event untuk memastikan visibilitas saat halaman dimuat
    $('#is_perusahaan').trigger('change');
   
    // Jenis Identitas
    $('#jenis_identitas').trigger('change');
        $('#jenis_identitas').on('change', function() {
        var selectedValue = $(this).val();

        
        if (selectedValue == "SIM") {
            $('#identitas_berlaku_form').slideDown();
            setIdBerlakuFormEnabled(true);
        } else {
            $('#identitas_berlaku_form').slideUp();
            setIdBerlakuFormEnabled(false);
            clearIdBerlakuForm();
        }
    });

    $('#jenis_identitas').trigger('change');
    });
</script>

@endsection