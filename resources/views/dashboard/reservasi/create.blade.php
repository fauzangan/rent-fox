@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Data Reservasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.reservasis.index') }}">Reservasi</a></div>
        <div class="breadcrumb-item">Tambah Reservasi</div>
    </div>
</div>

<div class="section-body">

    <div class="card">
        <div class="card-body">
            <div class="section-title mt-0">
                Reservasi
            </div>
            <form action="{{ route('dashboard.reservasis.store') }}" method="POST">
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
                                    value="{{ old('tanggal_reservasi') }}">
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
                                    old('status_reservasi_id')==$status_reservasi->status_reservasi_id ? 'selected' : ''
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
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" value="{{ old('nama_customer') }}">
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
                                    name="telp_customer" id="telp_customer" value="{{ old('telp_customer') }}">
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
                                    name="fax_customer" id="fax_customer" value="{{ old('fax_customer') }}">
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
                                    name="handphone" id="handphone" value="{{ old('handphone') }}">
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
                            <label>Telp Perusahaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('telp_perusahaan') is-invalid @enderror"
                                    name="telp_perusahaan" id="telp_perusahaan" value="{{ old('telp_perusahaan') }}">
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
                                    name="fax_perusahaan" id="fax_perusahaan" value="{{ old('fax_perusahaan') }}">
                                @error('fax_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek dan Alamat Proyek</label>
                            <textarea type="text" class="form-control" name="proyek" id="proyek">{{ old('proyek') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="section-title">Tambah Reservasi Item</div>
                @include('dashboard.orders.partials.create-item-order-form')
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah Data Reservasi</button>
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
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function () {
        new Cleave("#handphone", {
            phone: true,
            phoneRegionCode: "ID",
        });

        new Cleave("#telp_customer", {
            phone: true,
            phoneRegionCode: "ID",
        });

        new Cleave("#fax_customer", {
            phone: true,
            phoneRegionCode: "ID",
        });

        new Cleave("#telp_perusahaan", {
            phone: true,
            phoneRegionCode: "ID",
        });

        new Cleave("#fax_perusahaan", {
            phone: true,
            phoneRegionCode: "ID",
        });

        /* Pengaturan Tanggal Ditagihkan Input */
        $("#tanggal_reservasi").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            singleDatePicker: true,
            autoUpdateInput: false,
        });
        $("#tanggal_reservasi").attr(
            "placeholder",
            "dd/mm/yyyy"
        );
        $("#tanggal_reservasi").on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("DD/MM/YYYY"));
            }
        );
        $("#tanggal_reservasi").on(
            "cancel.daterangepicker",
            function (ev, picker) {
                $(this).val("");
            }
        );

        /* Mencegah memasukan tanggal yang salah */
        $("form").on("submit", function (e) {
            let tanggalDitagihkan = $("#tanggal_reservasi").val();

            if (!moment(tanggalDitagihkan, "DD/MM/YYYY", true).isValid()) {
                e.preventDefault();
                iziToast.error({
                    title: "Input Tanggal Salah/Kosong",
                    message:
                        "Tanggal tidak valid. Format yang benar adalah Hari/Bulan/Tahun.",
                    position: "topRight",
                });
            }

            let valid = true;
            $('.select-item').each(function() {
                if ($(this).val() === null || $(this).val() === 'Pilih Item') {
                    valid = false;
                }
            });

            if (!valid) {
                iziToast.error({
                    title: 'Reservasi Item',
                    message: 'Reservasi Item harus diisi!',
                    position: 'topRight'
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }
    // Fungsi untuk menambah formulir item baru
    $("#add-form-item").click(function() {
        var newItemForm = $(".form-item").first().clone(); // Salin formulir item pertama
        newItemForm.find('select,input').val(''); // Reset nilai input/select di formulir baru
        newItemForm.find('.jumlah-item').val(1);
        newItemForm.find('.waktu').val(1);
        $("#form-container").append(newItemForm); // Tambahkan formulir baru ke dalam kontainer
        
        // Tampilkan tombol hapus formulir jika jumlah formulir lebih dari 1
        if ($('.form-item').length > 1) {
            $('.delete-form-btn').show();
        }
    });

    // Fungsi untuk menghapus formulir item
    $(document).on("click", ".delete-form-btn", function() {
        var formsCount = $('.form-item').length;
        if (formsCount > 1) { // Pastikan setidaknya ada satu formulir tersisa
            $(this).closest('.form-item').remove(); // Hapus formulir
        } else {
            alert("Tidak dapat menghapus formulir terakhir.");
        }
        
        // Sembunyikan tombol hapus formulir jika jumlah formulir tinggal satu
        if ($('.form-item').length === 1) {
            $('.delete-form-btn').hide();
        }
    });

    // Fungsi untuk mengatur nilai field berdasarkan pilihan item
    $(document).on("change", ".select-item", function() {
        let container = $(this).closest('.form-item');
        let harga_sewa = $(this).find('option:selected').data('harga_sewa');
        let satuan_waktu = $(this).find('option:selected').data('satuan_waktu');
        let satuan_item = $(this).find('option:selected').data('satuan_item');
        let jumlah_item = container.find('.jumlah-item').val();

        container.find('.harga-sewa').val(harga_sewa);
        container.find('.satuan-waktu').val("Per " + satuan_waktu);
        container.find('.satuan-item').val(satuan_item);
        if(satuan_waktu == 'Bulan'){
            container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa) * parseInt(jumlah_item)));
        }else{
            container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa*30) * parseInt(jumlah_item)));
        }
    });

    $(document).on("change", ".jumlah-item", function(){
        let container = $(this).closest('.form-item');
        let jumlah_item = container.find('.jumlah-item').val();
        let harga_sewa = container.find('.harga-sewa').val();

        container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa) * parseInt(jumlah_item)));
    });
});
</script>
@endpush
@endsection