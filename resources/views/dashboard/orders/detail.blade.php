@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Detail Data Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.orders.index') }}">Manajemen Order</a></div>
        <div class="breadcrumb-item">Detail Data Order</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="section-title mb-3 mt-2">
                        <h5>Detail Order Kode :</h5>
                        <div class="border-box">{{ $order->order_id }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="section-title mb-3 mt-2">
                        <h5>Detail Pemesanan</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Tanggal Order</label>
                        <input type="text" class="form-control" value="{{  $order->tanggal_order->format('d/m/Y') }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kirim</label>
                        <input type="text" class="form-control" value="{{ $order->tanggal_kirim->format('d/m/Y') }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label>Kode Customer</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control"
                                    value="{{ old('customer_id', $order->customer_id) }}" disabled>
                            </div>
                            <div class="col-md-auto">
                                <button class="btn btn-primary mt-1">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Customer</label>
                        <input type="text" class="form-control" value="{{ $order->customer->nama }}" readonly>
                        @error('nama_customer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat Customer</label>
                        <textarea type="text" class="form-control" readonly>{{ $order->customer->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Handphone Customer</label>
                        <input type="text" class="form-control" value="{{ $order->customer->handphone }}" disabled>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Kirim Kepada</label>
                        <input type="text" class="form-control" value="{{ $order->kirim_kepada }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Alamat Kirim</label>
                        <textarea type="text" class="form-control" disabled>{{ $order->alamat_kirim }}</textarea>
                        @error('alamat_kirim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Proyek</label>
                        <textarea type="text" class="form-control" disabled>{{ $order->nama_proyek }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status Transport</label>
                        <input type="text" class="form-control" value="{{ $order->statusTransport->nama_status }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label>Status Order</label>
                        <input type="text" class="form-control" value="{{ $order->statusOrder->nama_status }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea type="text" class="form-control" disabled>{{ $order->keterangan }}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Subtotal</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="subtotal" value="{{ number_format($order->subtotal,0,",",".") }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Discount</label>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="discount" value="{{ $order->discount }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="discountHarga" disabled>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: black">
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Biaya Sewa</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="biayaSewa" value="{{ number_format($order->biaya_sewa,0,",",".") }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Transport Kirim</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="biayaTransport" value="{{ $order->biaya_transport }}">
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: black">
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Transport + Sewa</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="biayaTransportSewa" value="{{ number_format($order->biaya_transport_sewa,0,",",".") }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Down Payment</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="downPayment" value="{{ $order->down_payment }}">
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: black">
                    <div class="form-group form-group-row  row">
                        <label class="col-3 col-form-label">Sisa Rental</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="sisaRental" value="{{ number_format($order->sisa_rental,0,",",".") }}" disabled>
                            </div>
                        </div>
                    </div>
                    {{-- Dokument Printing --}}
                    <hr class="bg-primary pb-1">
                    <div class="section-title mb-3 mt-2">
                        <h5>Print Preview</h5>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Kontrak Set</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Kwitansi</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Order Rental</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Perjanjian Sewa</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Kondisi Barang</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Invoice</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Delivery Order</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success w-100" style="color: black">Surat Jalan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-title mt-2">
                <h5>Item Dipesan</h5>
            </div>
            @include('dashboard.orders.partials.detail-item-order')
        </div>
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

    .form-group-row {
        margin-bottom: 8px !important;
    }

    .section-title h5 {
        display: inline-block;
        /* Ensure h5 is inline for proper alignment */
        margin: 0;
        /* Remove default margin */
        vertical-align: middle;
        /* Align vertically in the middle */
    }

    .border-box {
        display: inline-block;
        /* Make sure the border box is inline */
        width: 70px;
        /* Width of the border box */
        height: 30px;
        /* Height of the border box */
        border: 2px solid black;
        /* Border style */
        box-sizing: border-box;
        /* Include border in the element's total width and height */
        vertical-align: middle;
        /* Align vertically in the middle */
        margin-left: 10px;
        /* Space between text and border box */
        text-align: center;
        /* Center text horizontally */
        line-height: 26px;
        /* Center text vertically by setting line-height equal to height minus borders */
    }
</style>
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script>
    $(document).ready(function() {

        // Load pertamakali di render
        loadDiscountHarga();

        new Cleave('#biayaTransport', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        new Cleave('#downPayment', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
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

        // String to int konversi
        function convertStringToInt(stringValue) {
            // Menghilangkan titik pada string
            var cleanedString = stringValue.replace(/\./g, '');
            // Mengubah string menjadi integer
            var integerValue = parseInt(cleanedString, 10);
            return integerValue;
        }

        $('#discount').on('change', function() {
            var orderId = {{ $order->order_id }};
            var discount = $(this).val();

            $.ajax({
                url: '{{ route('dashboard.orders.detail.post-discount', ['order' => $order->order_id]) }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    discount: discount
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topRight'
                        });
                        // Optionally, update other fields if needed
                        loadDiscountHarga();
                        loadOrderData();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    var errors = xhr.responseJSON.errors;
                    var errorMsg = '';
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMsg += errors[key][0] + ' ';
                        }
                    }
                    iziToast.error({
                        title: 'Error',
                        message: errorMsg,
                        position: 'topRight'
                    });
                }
            });
        });

        $('#biayaTransport').on('change', function() {
            var orderId = {{ $order->order_id }};
            var biayaTransport = $(this).val();

            $.ajax({
                url: '{{ route('dashboard.orders.detail.post-biaya-transport', ['order' => $order->order_id]) }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    biaya_transport: convertStringToInt(biayaTransport) 
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topRight'
                        });
                        // Optionally, update other fields if needed
                        loadOrderData();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    var errors = xhr.responseJSON.errors;
                    var errorMsg = '';
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMsg += errors[key][0] + ' ';
                        }
                    }
                    iziToast.error({
                        title: 'Error',
                        message: errorMsg,
                        position: 'topRight'
                    });
                }
            });
        });

        $('#downPayment').on('change', function() {
            var orderId = {{ $order->order_id }};
            var downPayment = $(this).val();

            $.ajax({
                url: '{{ route('dashboard.orders.detail.post-down-payment', ['order' => $order->order_id]) }}',
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    down_payment : convertStringToInt(downPayment) 
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topRight'
                        });
                        // Optionally, update other fields if needed
                        loadOrderData();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    var errors = xhr.responseJSON.errors;
                    var errorMsg = '';
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMsg += errors[key][0] + ' ';
                        }
                    }
                    iziToast.error({
                        title: 'Error',
                        message: errorMsg,
                        position: 'topRight'
                    });
                }
            });
        });

        function loadDiscountHarga(){
            let discount = parseFloat($('#discount').val()/100);
            let subtotal = convertStringToInt($('#subtotal').val());

            $('#discountHarga').val('Rp ' + formatRupiah(subtotal*discount));
        }

        function loadOrderData(){
            $.ajax({
                url: '{{ route('dashboard.orders.detail.get-order-data', ['order' => $order->order_id]) }}',
                type: 'GET',
                success: function(response) {
                    $('#biayaSewa').val('Rp '+formatRupiah(response.biaya_sewa));
                    $('#biayaTransportSewa').val('Rp '+formatRupiah(response.biaya_transport_sewa));
                    $('#sisaRental').val('Rp '+formatRupiah(response.sisa_rental));
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
        }


    });
</script>
@endpush

@endsection