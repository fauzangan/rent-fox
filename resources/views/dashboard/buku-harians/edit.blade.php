@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Data Buku Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.buku-harians.index') }}">Buku Harian</a></div>
        <div class="breadcrumb-item">Tambah Data Buku Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Input Data</h4>
        </div>
        <form action="{{ route('dashboard.buku-harians.update', ['bukuHarian' => $buku_harian->buku_harian_id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="form-group">
                            <label>Kode Posting</label>
                            <select class="form-control @error('posting_biaya_id') is-invalid @enderror" id="posting_biaya_id" name="posting_biaya_id">
                                <option selected disabled>Pilih Kode Posting...</option>
                                @foreach($group_biayas as $group_biaya)
                                <optgroup label="{{ $group_biaya->nama_group }} (Kode Group: {{ $group_biaya->prefiks }})">
                                    @foreach($group_biaya->postingBiayas as $posting_biaya)
                                    <option value="{{ $posting_biaya->posting_biaya_id }}" {{ old('posting_biaya_id', $buku_harian->posting_biaya_id) == $posting_biaya->posting_biaya_id ? 'selected' : '' }}>{{ $posting_biaya->posting_biaya_id }} | {{ $posting_biaya->nama_posting }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @error('posting_biaya_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <select class="form-control select2 @error('order_id') is-invalid @enderror" id="order_id" name="order_id">
                                <option disabled selected> </option>
                                @foreach($orders as $order)
                                <option value="{{ $order->order_id }}" data-customer_id="{{ $order->customer_id }}" {{ old('order_id', $buku_harian->order_id) == $order->order_id ? 'selected' : '' }}>{{ $order->order_id }}</option>
                                @endforeach
                            </select>
                            @error('order_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-1 pr-0">
                        <div class="form-group">
                            <label>Kode Cust</label>
                            <input class="form-control" type="text" disabled id="customer_id" value="{{ old('customer_id', $buku_harian->order->customer_id) }}">
                            @error('customer_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2 pr-0">
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                    id="tanggal_transaksi" name="tanggal_transaksi"
                                    value="{{ old('tanggal_transaksi', $buku_harian->tanggal_transaksi->format('d/m/Y')) }}">
                                @error('tanggal_transaksi')
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
                            <select id="keterangan" name="keterangan" class="form-control">
                                <option value="Administrasi Bank">Administrasi Bank</option>
                                <option value="BBM">BBM</option>
                                <option value="Bunga Bank">Bunga Bank</option>
                                <option value="Claim Hilang">Claim Hilang</option>
                                <option value="Claim Rusak Ringan">Claim Rusak Ringan</option>
                                <option value="Claim Rusak Berat">Claim Rusak Berat</option>
                                <option value="Gaji Staff">Gaji Staff</option>
                                <option value="IMK, Jembatan Timbang, Retribusi">IMK, Jembatan Timbang, Retribusi</option>
                                <option value="Lebih Bayar">Lebih Bayar</option>
                                <option value="Ongkos KB-KB">Ongkos KB-KB</option>
                                <option value="Operasional">Operasional</option>
                                <option value="Pajak Bunga Bank">Pajak Bunga Bank</option>
                                <option value="Pembelian Alat Tulis Kantor">Pembelian Alat Tulis Kantor</option>
                                <option value="Pembelian Material">Pembelian Material</option>
                                <option value="Pembelian Pita Printer">Pembelian Pita Printer</option>
                                <option value="Pengiriman Dokumen">Pengiriman Dokumen</option>
                                <option value="Pendapatan Transport">Pendapatan Transport</option>
                                <option value="Pelunasan Order Awal">Pelunasan Order Awal</option>
                                <option value="Pelunasan Tagihan Perpanjang">Pelunasan Tagihan Perpanjang</option>
                                <option value="Pelunasan Tagihan Periode Final">Pelunasan Tagihan Periode Final</option>
                                <option value="Penerimaan Tanggungan">Penerimaan Tanggungan</option>
                                <option value="Pengembalian Tanggungan">Pengembalian Tanggungan</option>
                                <option value="PLN">PLN</option>
                                <option value="Kasbon Staff">Kasbon Staff</option>
                                <option value="Sebagian Order Awal">Sebagian Order Awal</option>
                                <option value="Sebagian Tagihan Perpanjang">Sebagian Tagihan Perpanjang</option>
                                <option value="Sebagian Tagihan Periode Final">Sebagian Tagihan Periode Final</option>
                                <option value="Telp">Telp</option>
                                <option value="Tol">Tol</option>
                                <option value="Transport Penagihan">Transport Penagihan</option>
                                <option value="Uang Lembur">Uang Lembur</option>
                                <option value="Uang Makan">Uang Makan</option>
                                <option value="Upah Harian">Upah Harian</option>
                                <option value="Upah Supir">Upah Supir</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Debit</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('debit') is-invalid @enderror" name="debit" id="debit" value="{{ old('debit', $buku_harian->debit) }}">
                            </div>
                            @error('debit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Kredit</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('kredit') is-invalid @enderror" name="kredit" id="kredit" value="{{ old('kredit', $buku_harian->kredit) }}">
                            </div>
                            @error('kredit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Saldo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('saldo') is-invalid @enderror" disabled id="saldo" value="{{ old('saldo', $buku_harian->saldo) }}">
                            </div>
                            @error('saldo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2 pr-0">
                        <div class="form-group">
                            <label>Status Data</label>
                            <select class="form-control select2 @error('data_buku_harian_id') is-invalid @enderror" id="data_buku_harian_id" name="data_buku_harian_id">
                                @foreach($data_buku_harians as $data_buku_harian)
                                <option value="{{ $data_buku_harian->data_buku_harian_id }}" {{ old('data_buku_harian_id', $buku_harian->data_buku_harian_id) == $data_buku_harian->data_buku_harian_id ? 'selected' : '' }}>{{ $data_buku_harian->nama_data }}</option>
                                @endforeach
                            </select>
                            @error('data_buku_harian_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Vendor</label>
                            <input type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" value="{{ old('vendor', $buku_harian->vendor) }}">
                            @error('vendor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right pt-0">
                <button type="submit" class="btn btn-warning">Edit Data Buku Harian</button>
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
                <div class="col-2 pr-0">
                    <div class="form-group">
                        <label for="">Customer</label>
                        <input type="text" class="form-control" id="showCustomerName" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Perusahaan</label>
                        <input type="text" class="form-control" id="showPerusahaan" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Proyek</label>
                        <input type="text" class="form-control" id="showProyek" disabled>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="">Lokasi</label>
                        <input type="text" class="form-control" id="showAlamatKirim" disabled>
                    </div>
                </div>
                <div class="col-md-auto d-flex flex-column">
                    <button id="detail-order-button" class="btn btn-info mb-1">Detail Order</button>
                    <button id="detail-tagihan-button" class="btn btn-warning">Detail Tagihan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Order -->
@include('dashboard.buku-harians.partials.modal-orders')
<!-- Modal Order -->

<!-- Modal Tagihan -->
@include('dashboard.buku-harians.partials.modal-tagihans')
<!-- Modal Tagihan -->
  

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Spesific Page -->
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {

        $(document).on('click', '#detail-order-button', function() {
            $('#orderModal').appendTo("body").modal('show');
        });

        $(document).on('click', '#detail-tagihan-button', function() {
            $('#tagihanModal').appendTo("body").modal('show');
        });

        // Simpan nilai asli dari debit dan kredit
        let originalDebitValue = $('#debit').val();
        let originalKreditValue = $('#kredit').val();
        // Panggil fungsi saat dokumen selesai dimuat
        updateOrderData();
        updatePostingFields();

        // inisiasi nilai saldo field
        if(originalDebitValue == 0){
            getSaldo(null, convertStringToInt(originalKreditValue));
        }else{
            getSaldo(convertStringToInt(originalDebitValue), null);
        }

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

        function convertStringToInt(stringValue) {
            // Menghilangkan titik pada string
            var cleanedString = stringValue.replace(/\./g, '');
            // Mengubah string menjadi integer
            var integerValue = parseInt(cleanedString, 10);
            return integerValue;
        }

        new Cleave('#debit', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        new Cleave('#kredit', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        new Cleave('#saldo', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        $('#keterangan').editableSelect();

        // Fungsi untuk mengisi data customer
        function fillCustomerData(customerId) {
            // Isi nilai input dengan data customer yang dipilih
            $('#customer_id').val(customerId);
        }

        // fungsi ajax untuk mengisi data order
        function getOrderData(orderId){
            $.ajax({
                url: '/dashboard/buku-harians/getOrderData/' + orderId,
                method: 'GET',
                success: function(response) {
                    $('#showOrderId').val(response.order_id);
                    $('#modalOrderId').text(response.order_id);
                    $('#modalTagihanOrderId').text(response.order_id);
                    $('#modalTotalHarga').val('Rp '+formatRupiah(parseInt(response.subtotal)));
                    $('#modalDiscount').val(response.discount+'%');
                    $('#modalTotalHargaDisc').val('Rp '+formatRupiah(parseInt(response.biaya_sewa)));
                    $('#modalBiayaTransport').val('Rp '+formatRupiah(parseInt(response.biaya_transport)));
                    $('#showProyek').val(response.nama_proyek);
                    $('#showAlamatKirim').val(response.alamat_kirim);

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
                    console.error('Error getting order details:', error);
                },
            });
        }

        function getSaldo(debit, kredit){
            $.ajax({
                url: '{{ route('dashboard.buku-harians.getSaldoData-edit', ['bukuHarian' => $buku_harian->buku_harian_id]) }}',
                method: 'GET',
                success: function(response) {
                    if(debit){
                        $('#saldo').val(formatRupiah(parseInt(response) - debit));
                    }else if(kredit){
                        $('#saldo').val(formatRupiah(parseInt(response) + kredit));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error getting saldo value:', error);
                },
            });
        }

        function getCustomerData(customerId){
            $.ajax({
                url: '/dashboard/buku-harians/getCustomerData/' + customerId,
                method: 'GET',
                success: function(response) {
                    $('#showCustomerName').val(response.nama);
                    if(response.perusahaan != null){
                        $('#showPerusahaan').val(response.perusahaan.badan_hukum+' '+response.perusahaan.nama);
                    }else{
                        $('#showPerusahaan').val('-');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error getting customer details:', error);
                },
            });
        }

        function updateOrderData() {
            let orderId = $("#order_id").val();
            let selectedOption = $("#order_id").find('option:selected');
            let customerId = selectedOption.data('customer_id');

            fillCustomerData(customerId);
            getCustomerData(customerId);
            getOrderData(orderId);
        }

        // Event listener untuk perubahan pada select
        $("#order_id").change(function() {
            updateOrderData();
        });

        // Event listener untuk perubahan saldo
        $("#kredit").change(function () {
            let kreditVal = convertStringToInt($(this).val());

            getSaldo(null, kreditVal);
        });

        $("#debit").change(function () {
            let debitVal = convertStringToInt($(this).val());

            getSaldo(debitVal, null);
        });

        /* Pengaturan Tanggal Ditagihkan Input */
        $("#tanggal_transaksi").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            singleDatePicker: true,
            autoUpdateInput: false,
        });

        $("#tanggal_transaksi").attr(
            "placeholder",
            "dd/mm/yyyy"
        );

        $("#tanggal_transaksi").on(
            "apply.daterangepicker",
            function (ev, picker) {
                $(this).val(picker.startDate.format("DD/MM/YYYY"));
            }
        );

        $("#tanggal_transaksi").on(
            "cancel.daterangepicker",
            function (ev, picker) {
                $(this).val("");
            }
        );

        /* Mencegah memasukan tanggal yang salah */
        $("form").on("submit", function (e) {
            let tanggalTransaksi = $("#tanggal_transaksi").val();

            if (!moment(tanggalTransaksi, "DD/MM/YYYY", true).isValid()) {
                e.preventDefault();
                iziToast.error({
                    title: "Input Tanggal Salah/Kosong",
                    message:
                        "Tanggal tidak valid. Format yang benar adalah Hari/Bulan/Tahun.",
                    position: "topRight",
                });
            }
        });



        // update posting field
        function updatePostingFields() {
            let selectedOption = $('#posting_biaya_id').val();
            let debitField = $('#debit');
            let kreditField = $('#kredit');
            // Reset Saldo Value
            $('#saldo').val('');

            if (selectedOption.charAt(0) === 'A' || selectedOption.charAt(0) === 'C') {
                debitField.val(0);
                debitField.prop('readonly', true);
                kreditField.val(formatRupiah(originalKreditValue));
                kreditField.prop('readonly', false);
            } else {
                debitField.prop('readonly', false);
                debitField.val(formatRupiah(originalDebitValue));
                kreditField.prop('readonly', true);
                kreditField.val(0);
            }
        }

        // Event listener untuk perubahan pada select
        $('#posting_biaya_id').on('change', function() {
            updatePostingFields();
        });

    });
</script>
<script>
    
</script>
@endpush
@endsection