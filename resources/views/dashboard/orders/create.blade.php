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
        {{-- <div class="card-header">
            <h4>Tambah Data Order</h4>
        </div> --}}
        <div class="card-header">
            test
        </div>
        <div class="card-body">
            <form action="">
                <div class="section-title mt-0">
                    Orders
                    {{-- <div class="box" style="display: inline">
                        <strong>Kode Order: 15</strong>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" class="form-control" name="tanggal_order">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <input type="text" class="form-control" name="tanggal_kirim">
                        </div>
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <select class="form-control select2" id="customer_select">
                                <option selected disabled>Pilih Customer</option>
                                @foreach($customers as $customer)
                                <option value={{ $customer->customer_id }} data-nama="{{ $customer->nama }}"
                                    data-alamat="{{
                                    $customer->alamat }}" data-kota="{{ $customer->kota }}" data-telp="{{ $customer->fax
                                    }}"
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
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat Customer</label>
                            <textarea type="text" class="form-control" name="alamat_customer" id="alamat_customer"
                                value="" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kota Customer</label>
                            <input type="text" class="form-control" name="kota_customer" id="kota_customer" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Telp Customer</label>
                            <input type="text" class="form-control" name="telp_customer" id="telp_customer" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Fax Customer</label>
                            <input type="text" class="form-control" name="fax_customer" id="fax_customer" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <div class="row">
                                <div class="col-3 pr-1">
                                    <input type="text" class="form-control" name="badan_hukum" id="badan_hukum" value=""
                                        readonly>
                                </div>
                                <div class="col-9 pl-1">
                                    <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                        value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Perusahaan</label>
                            <textarea type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan"
                                value="" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Kota Perusahaan</label>
                            <input type="text" class="form-control" name="kota_perusahaan" id="kota_perusahaan" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Telp Perusahaan</label>
                            <input type="text" class="form-control" name="telp_perusahaan" id="telp_perusahaan" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Fax Perusahaan</label>
                            <input type="text" class="form-control" name="fax_perusahaan" id="fax_perusahaan" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Kirim Kepada</label>
                            <input type="text" class="form-control" name="kirim_kepada" id="kirim_kepada">
                        </div>
                        <div class="form-group">
                            <label>Alamat Kirim</label>
                            <textarea type="text" class="form-control" name="alamat_kirim" id="alamat_kirim"></textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <textarea type="text" class="form-control" name="nama_proyek" id="nama_proyek"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Transport</label>
                            <select class="form-control" name="status_transport" id="status_transport">
                                <option value="ASR">Oleh ASR</option>
                                <option value="Mandiri">Mandiri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status Order</label>
                            <select class="form-control" name="status_order" id="status_order">
                                <option value=1>Aktif</option>
                                <option value=0>Non Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                        </div>
                    </div>
                </div>

                <div class="section-title">Items</div>
                <div id="form-container">
                    <div class="form-group" id="item_form">
                        <div class="row">
                            <div class="col pr-1">
                                <label>Kode Item</label>
                                <select class="form-control select2" id="item_id" name="item_id[]">
                                    @foreach($items as $item)
                                    <option value="{{ $item->item_id }}">{{ $item->item_id }} | {{ $item->nama_item }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col col-sm-2 pr-1">
                                <label>Harga Sewa</label>
                                <input type="text" id="harga_sewa" class="form-control" disabled readonly>
                            </div>
                            <div class="col-1 pr-1">
                                <label>Kuantitas</label>
                                <input type="text" id="jumlah_item" class="form-control" name="jumlah_item"
                                    name="jumlah_item[]">
                            </div>
                            <div class="col-1 pr-1">
                                <label>Satuan</label>
                                <input type="text" id="satuan" class="form-control" value="buah" disabled readonly>
                            </div>
                            <div class="col col-sm-2 pr-1">
                                <label>Satuan Waktu</label>
                                <input type="text" id="satuan" class="form-control" disabled readonly>
                            </div>
                            <div class="col col-sm-1 pr-1">
                                <label>Waktu</label>
                                <input type="text" id="satuan" class="form-control" value="1">
                            </div>
                            <div class="col">
                                <label>Jumlah</label>
                                <input type="text" id="satuan" class="form-control" disabled readonly>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger delete-form-btn"
                                    style="margin-top: 32px;">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="button" id="add-form-btn">Tambah Item</button>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah Order Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
{{--
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}"> --}}
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
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
{{-- <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
<script>
    $(document).ready(function(){
        $("#customer_select").change(function(){
            let nama = $(this).find('option:selected').data('nama');
            let alamat = $(this).find('option:selected').data('alamat');
            let kota = $(this).find('option:selected').data('kota');
            let telp = $(this).find('option:selected').data('telp');
            let fax = $(this).find('option:selected').data('fax');
            let badan_hukum = $(this).find('option:selected').data('badan_hukum');
            let nama_perusahaan = $(this).find('option:selected').data('nama_perusahaan');
            let alamat_perusahaan = $(this).find('option:selected').data('alamat_perusahaan');
            let kota_perusahaan = $(this).find('option:selected').data('kota_perusahaan');
            let telp_perusahaan = $(this).find('option:selected').data('telp_perusahaan');
            let fax_perusahaan = $(this).find('option:selected').data('fax_perusahaan');
            
            // Isi nilai input dengan data customer yang dipilih
            $('#nama_customer').val(nama);
            $('#alamat_customer').text(alamat);
            $('#kota_customer').val(kota);
            $('#telp_customer').val(telp);
            $('#fax_customer').val(fax);
            $('#badan_hukum').val(badan_hukum);
            $('#nama_perusahaan').val(nama_perusahaan);
            $('#alamat_perusahaan').text(alamat_perusahaan);
            $('#kota_perusahaan').val(kota_perusahaan);
            $('#telp_perusahaan').val(telp_perusahaan);
            $('#fax_perusahaan').val(fax_perusahaan);
        });
    });
</script>
@endpush

@endsection