@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Tagihan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.tagihans.index') }}">Manajemen Tagihan</a></div>
        <div class="breadcrumb-item">Tambah Tagihan</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Form Tambah Tagihan</h4>
        </div>
        <form action="{{ route('dashboard.tagihans.create') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Kode Order<span class="text-danger" data-toggle="tooltip"
                                            title="Wajib Diisi!">*</span></label>
                                    <select class="form-control select2" name="order_id" id="order_id">
                                        <option disabled selected>Pilih Kode Order</option>
                                        @foreach($orders as $order)
                                        <option value="{{ $order->order_id }}"
                                            data-customer_id="{{ $order->customer_id }}" data-nama_customer="{{ $order->nama_customer }}" data-badan_hukum="{{ $order->badan_hukum?? '' }}" data-nama_perusahaan="{{ $order->nama_perusahaan?? '' }}" data-proyek="{{ $order->nama_proyek }}">{{
                                            $order->order_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Kode Customer</label>
                                    <input type="text" class="form-control" id="customer_id" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" id="nama_customer" readonly>
                        </div>
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <div class="row">
                                <div class="col-3 pr-1">
                                    <input type="text" class="form-control" id="badan_hukum" value="" readonly>
                                </div>
                                <div class="col-9 pl-1">
                                    <input type="text" class="form-control" id="nama_perusahaan" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis Tagihan<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control select2" name="jenis_tagihan_id" id="jenis_tagihan_id">
                                <option disabled selected>Pilih Jenis Tagihan</option>
                                @foreach($jenis_tagihans as $jenis_tagihan)
                                <option value="{{ $jenis_tagihan->jenis_tagihan_id }}">{{$jenis_tagihan->nama_tagihan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Ditagihkan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="tanggal_ditagihkan"
                                    name="tanggal_ditagihkan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jatuh Tempo 1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="jatuh_tempo_1" name="jatuh_tempo_1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jatuh Tempo 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="jatuh_tempo_2" name="jatuh_tempo_2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Tagihan<span class="text-danger" data-toggle="tooltip" title="Wajib Diisi!">*</span></label>
                            <select class="form-control select2" name="status_tagihan_id" id="status_tagihan_id">
                                <option disabled selected>Pilih Status Tagihan</option>
                                @foreach($status_tagihans as $status_tagihan)
                                <option value="{{ $status_tagihan->status_tagihan_id }}">{{ $status_tagihan->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Tagihan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control currency">
                            </div>
                        </div>
                    </div>
                    <div class="col" >
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Apakah DP ?<span class="text-danger" data-toggle="tooltip"
                                    title="Wajib Diisi!">*</span></label>
                            <select class="form-control" name="is_dp" id="is_dp">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
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
                                    <input type="text" class="form-control currency">
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
                                    <input type="text" class="form-control currency">
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
                                    <input type="text" class="form-control currency">
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
                                    <input type="text" class="form-control currency">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Tambah Tagihan Baru</button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
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
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#order_id").change(function(){
            let customer_id = $(this).find('option:selected').data('customer_id');
            let nama_customer = $(this).find('option:selected').data('nama_customer');
            let badan_hukum = $(this).find('option:selected').data('badan_hukum');
            let nama_perusahaan = $(this).find('option:selected').data('nama_perusahaan');
            let proyek = $(this).find('option:selected').data('proyek');
    
            // Isi nilai input dengan data customer yang dipilih
            $('#customer_id').val(customer_id);
            $('#nama_customer').val(nama_customer);
            $('#badan_hukum').val(badan_hukum);
            $('#nama_perusahaan').val(nama_perusahaan);
            $('#nama_proyek').val(proyek);

        }); 

        // Fungsi untuk menghapus nilai dari elemen input dan textarea
    function clearDpForm() {
        $("#dp-form").find("input, textarea").val("");
    }

    // Fungsi untuk mengatur status aktif dari elemen input dan textarea
    function setDpFormEnabled(enabled) {
        $("#dp-form").find("input, select, textarea").prop("disabled", !enabled);
    }

        // Mendengarkan perubahan pada elemen select "is_dp"
        $("#is_dp").on("change", function () {
        var selectedValue = $(this).val();

        // Menampilkan atau menyembunyikan form perusahaan berdasarkan nilai yang dipilih
        if (selectedValue == "1") {
            // Jika opsi "Perusahaan" dipilih, tampilkan form perusahaan dan aktifkan input
            $("#dp-form").slideDown();
            setDpFormEnabled(true);
        } else {
            // Jika opsi "Diri Sendiri" dipilih, sembunyikan form perusahaan, nonaktifkan input, dan hapus nilai input
            $("#dp-form").slideUp();
            setDpFormEnabled(false);
            clearDpForm();
        }
    });
    // Trigger change event untuk memastikan visibilitas saat halaman dimuat
    $("#is_dp").trigger("change");

    });
</script>
@endpush
@endsection