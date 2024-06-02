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
        <form action="{{ route('dashboard.tagihans.create') }}" method="POST" id="form-tagihan">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Kode Order<span class="text-danger" data-toggle="tooltip"
                                            title="Wajib Diisi!">*</span></label>
                                    <select class="form-control select2 @error('order_id') is-invalid @enderror"
                                        name="order_id" id="order_id">
                                        <option disabled selected>Pilih Kode Order</option>
                                        @foreach($orders as $order)
                                        <option value="{{ $order->order_id }}" {{ old('order_id')==$order->order_id ?
                                            'selected' : '' }} data-customer_id="{{ $order->customer_id }}"
                                            data-nama_customer="{{ $order->customer->nama }}" data-badan_hukum="{{
                                            $order->customer->perusahaan->badan_hukum?? '' }}" data-nama_perusahaan="{{
                                            $order->customer->perusahaan->nama?? '' }}" data-proyek="{{ $order->nama_proyek }}">{{
                                            $order->order_id }}</option>
                                        @endforeach
                                    </select>
                                    @error('order_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>Kode Customer</label>
                                    <input type="text" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror"
                                        id="customer_id" readonly value="{{ old('customer_id') }}">
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
                                id="nama_customer" readonly value="{{ old('nama_customer') }}">
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
                                        id="badan_hukum" readonly value="{{ old('badan_hukum') }}">
                                    @error('badan_hukum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-9 pl-1">
                                    <input type="text"
                                        name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        id="nama_perusahaan" readonly value="{{ old('nama_perusahaan') }}">
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
                                id="nama_proyek" readonly value="{{ old('nama_proyek') }}">
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
                                <option value="{{ $jenis_tagihan->jenis_tagihan_id }}" {{
                                    old('jenis_tagihan_id')==$jenis_tagihan->jenis_tagihan_id ? 'selected' : '' }}
                                    >{{$jenis_tagihan->nama_tagihan }}</option>
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
                            <label>Tanggal Ditagihkan<span class="text-danger" data-toggle="tooltip" title="Wajib Diisi!">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text"
                                    class="form-control @error('tanggal_ditagihkan') is-invalid @enderror"
                                    id="tanggal_ditagihkan" name="tanggal_ditagihkan"
                                    value="{{ old('tanggal_ditagihkan') }}">
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
                                    id="jatuh_tempo_1" name="jatuh_tempo_1" value="{{ old('jatuh_tempo_1') }}">
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
                                    id="jatuh_tempo_2" name="jatuh_tempo_2" value="{{ old('jatuh_tempo_2') }}">
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
                                    old('status_tagihan_id')==$status_tagihan->status_tagihan_id ? 'selected' : '' }}
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
                                    value="{{ old('jumlah_tagihan') }}">
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
                                name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Apakah DP ?</label>
                            <select class="form-control @error('is_dp') is-invalid @enderror" name="is_dp" id="is_dp">
                                <option value="0" {{ old('is_dp')=='0' ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ old('is_dp')=='1' ? 'selected' : '' }}>Ya</option>
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
                                    <input type="text" name="total_dp" class="form-control @error('total_dp') is-invalid @enderror" value="{{ old('total_dp') }}" id="total_dp">
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
                                    <input type="text" name="dp1" id="dp_1"
                                        class="form-control @error('dp1') is-invalid @enderror"
                                        value="{{ old('dp1') }}">
                                    @error('dp1')
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
                                    <input type="text" name="dp2" id="dp_2"
                                        class="form-control @error('dp2') is-invalid @enderror"
                                        value="{{ old('dp2') }}">
                                    @error('dp2')
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
                                    <input type="text" name="dp3" id="dp_3"
                                        class="form-control @error('dp3') is-invalid @enderror"
                                        value="{{ old('dp3') }}">
                                    @error('dp3')
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
                <button type="submit" class="btn btn-primary">Tambah Tagihan Baru</button>
            </div>
        </form>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <div class="row">
                <div class="col-1 pr-0">
                    <div class="form-group">
                        <label for="">Kode Order</label>
                        <input type="text" class="form-control" id="showOrderId" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Subtotal</label>
                        <input type="text" class="form-control" id="showSubtotal" disabled>
                    </div>
                </div>
                <div class="col-1 pr-0">
                    <div class="form-group">
                        <label for="">Discount</label>
                        <input type="text" class="form-control" id="showDiscount" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Biaya Sewa</label>
                        <input type="text" class="form-control" id="showBiayaSewa" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Biaya Transport</label>
                        <input type="text" class="form-control" id="showBiayaTransport" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Down Payment</label>
                        <input type="text" class="form-control" id="showDownPayment" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Sisa Rental</label>
                        <input type="text" class="form-control" id="showSisaRental" disabled>
                    </div>
                </div>
                <div class="col-md-auto d-flex flex-column">
                    <button id="detail-order-button" class="btn btn-info mb-1">Order Item</button>
                    <button id="detail-tagihan-button" class="btn btn-warning">Tagihan Tercatat</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Order -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Detail Order Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive text-nowrap text-center">
                        <table id="modalOrderItems" class="table table-hover table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr style="background-color:gainsboro">
                                    <td colspan="3"><strong>Subtotal Harga Sewa</strong></td>
                                    <td><strong><span id="modalSubtotal"></span></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Order -->

<!-- Modal Tagihan -->
<div class="modal fade" id="tagihanModal" tabindex="-1" aria-labelledby="tagihanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagihanModalLabel">Tagihan Tercatat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive text-nowrap text-center">
                        <table id="modalTagihans" class="table table-hover table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>Kode Tagihan</th>
                                    <th>Jenis Tagihan</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tagihan -->

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
<script>
    $(document).ready(function(){
        $(document).on('click', '#detail-order-button', function() {
            $('#orderModal').appendTo("body").modal('show');
        });

        $(document).on('click', '#detail-tagihan-button', function() {
            $('#tagihanModal').appendTo("body").modal('show');
        });

        // Ubah String menjadi format rupiah
        function formatRupiah(angka) {
            // Konversi angka menjadi string dan simpan tanda negatif jika ada
            var isNegative = false;
            if (angka < 0) {
                isNegative = true;
                angka = Math.abs(angka);
            }

            // Balikkan string, bagi menjadi grup ribuan, gabungkan kembali, dan balikkan lagi
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');

            // Tambahkan kembali tanda negatif jika diperlukan
            if (isNegative) {
                ribuan = '-' + ribuan;
            }

            return ribuan;
        }

        $('#order_id').change(function(){
            let orderId = $(this).val();
            
            $.ajax({
                url: '/dashboard/tagihans/getOrderData/' + orderId,
                type: 'GET',
                success: function(response) {
                    $('#showOrderId').val(orderId);
                    $('#showSubtotal').val('Rp '+formatRupiah(response.subtotal));
                    $('#modalSubtotal').text('Rp '+formatRupiah(response.subtotal));
                    $('#showDiscount').val(response.discount+'%');
                    $('#showBiayaSewa').val('Rp '+formatRupiah(response.biaya_sewa));
                    $('#showBiayaTransport').val('Rp '+formatRupiah(response.biaya_transport));
                    $('#showDownPayment').val('Rp '+formatRupiah(response.down_payment));
                    $('#showSisaRental').val('Rp '+formatRupiah(response.sisa_rental));

                    if(response.order_items != null){
                        var rows = "";
                        $.each(response.order_items, function (key, orderItem) {
                            rows += "<tr>";
                            rows += "<td>" + orderItem.item_id + "</td>";
                            rows += "<td>" + orderItem.nama_item + "</td>";
                            rows += "<td>" + orderItem.jumlah_item + "</td>";
                            rows += "<td>" + 'Rp '+formatRupiah(parseInt(orderItem.jumlah_harga)) + "</td>";
                            rows += "</tr>";
                        });
                        $("#modalOrderItems tbody").html(rows);
                    }

                    if(response.tagihans != null){
                        var rows = "";
                        $.each(response.tagihans, function (key, tagihan) {
                            rows += "<tr>";
                            rows += "<td>" + tagihan.tagihan_id + "</td>";
                            rows += "<td>" + tagihan.jenis_tagihan.nama_tagihan + "</td>";
                            rows += "<td>" + 'Rp '+formatRupiah(parseInt(tagihan.jumlah_tagihan)) + "</td>";
                            rows += "<td>" + tagihan.status_tagihan.nama_status + "</td>";
                            rows += "</tr>";
                        });
                        $("#modalTagihans tbody").html(rows);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    var errors = xhr.responseJSON.errors;
                    iziToast.error({
                        title: 'Error Load Data',
                        message: error,
                        position: 'topRight'
                    });
                }
            });
        });
    });
</script>
@endpush
@endsection