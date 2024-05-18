@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Logistik/Gudang Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Logistik/Gudang Harian</div>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Input Log Harian</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3 pr-0">
                    <div class="form-group">
                        <label>Status Order</label>
                        <select class="form-control select2">
                            <option>Pengiriman</option>
                            <option>Pengembalian</option>
                        </select>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Kode Order</label>
                        <select class="form-control select2" id="order_id">
                            <option value="" selected>Kosong</option>
                            @foreach($orders as $order)
                            <option value="{{ $order->order_id }}" data-customer_id="{{ $order->customer_id }}">{{
                                $order->order_id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-3 pr-0">
                    <div class="form-group">
                        <label>Kode Item</label>
                        <select class="form-control select2" id="selectItemId">
                            <option selected disabled>Pilih Item</option>
                        </select>
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Sat.</label>
                        <input type="text" class="form-control" readonly id="satuan">
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Jumlah Baik</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Rusak Ringan</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Rusak Berat</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col pr-0">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" readonly name="jumlah_item" id="jumlah_item">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right pt-0">
            <button type="submit" class="btn btn-primary">Tambah Log Harian</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Order Aktif Customer</h4>
                </div>
                <div class="card-body p-0" id="customerOrderTable" style="display: none;">
                    <table class="table table-md">
                        <thead>
                            <tr>
                                <th>Kode Cust</th>
                                <th>Kode Order</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Item Per Order Ini</h4>
                </div>
                <div class="card-body p-0" id="orderItemsTable" style="display: none;">
                    <table class="table table-md">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Order dg. Item INI per Customer INI</h4>
                </div>
                <div class="card-body p-0" id="itemOrderCustomer" style="display: none;">
                    <table class="table table-md">
                        <thead>
                            <tr>
                                <th class="py-1">Kode<br> Item</th>
                                <th class="py-1">Nama</th>
                                <th class="py-1">Sat.</th>
                                <th class="py-1">Jumlah<br> Item</th>
                                <th class="py-1">Kode<br> Order</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#order_id').change(function() {
            var orderId = $(this).val();
            var customerId = $(this).find('option:selected').data('customer_id');
            if (orderId) {
                $.ajax({
                    url: '/dashboard/logistik-harians/getOrderItem/' + orderId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var selectItemId = $('#selectItemId');
                        selectItemId.html('<option selected disabled>Pilih Item</option>'); 
                        if (data.length > 0) {
                            var options = '';
                            $.each(data, function(key, item) {
                                options += '<option value="'+ item.item_id +'">' + item.item_id + ' | ' + item.nama_item + "</option>";
                            });
                            selectItemId.append(options);

                            $('#orderItemsTable').slideDown();
                            var rows = '';
                            $.each(data, function(key, item) {
                                rows += '<tr>';
                                rows += '<td>' + item.item_id + '</td>';
                                rows += '<td>' + item.nama_item + '</td>';
                                rows += '<td>' + item.jumlah_item + '</td>';
                                rows += '</tr>';
                            });
                            $('#orderItemsTable tbody').html(rows);
                        } else {
                            $('#orderItemsTable').slideUp();
                        }
                    }
                });
                
            } else {
                $('#orderItemsTable').slideUp();
                $('#selectItemId').html('<option selected disabled>Pilih Item</option>');
            }

            if (customerId) {
                $.ajax({
                    url: '/dashboard/logistik-harians/getCustomerOrders/' + customerId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if(data.length > 0){
                            $('#customerOrderTable').slideDown();
                            var rows = '';
                            $.each(data[0].orders, function(key, item){
                                rows += '<tr>';
                                rows += '<td>' + item.customer_id + '</td>';
                                rows += '<td>' + item.order_id + '</td>';
                                rows += '<td>' + 'Aktif' + '</td>';
                                rows += '</tr>';
                            });
                            $('#customerOrderTable tbody').html(rows);
                        } else {
                            $('#customerOrderTable').slideUp();
                        }
                    }
                });
            } else {
                $('#customerOrderTable').slideUp();
                $('#itemOrderCustomer').slideUp();
                $('#jumlah_item').val('');
                $('#satuan').val('');
            }
        });

        $('#selectItemId').change(function() {
            var orderItemId = $(this).val();
            var customerId = $('#order_id').find('option:selected').data('customer_id');
            var orderId = $('#order_id').val();
            if (orderId) {
                $.ajax({
                    url: '/dashboard/logistik-harians/getOrderItem/' + orderId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var itemId = null;
                        $.each(data, function(key, item) {
                            if (item.item_id == orderItemId) {
                                itemId = item.item_id;
                                $('#jumlah_item').val(item.jumlah_item);
                                $('#satuan').val(item.satuan);
                                
                            }
                        });
                    
                    if(itemId != null){
                        $.ajax({
                            url: '/dashboard/logistik-harians/getCustomerOrders/' + customerId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                if(data.length > 0){
                                    $('#itemOrderCustomer').slideDown();
                                    var rows = '';
                                    $.each(data[0].orders, function(key, order){
                                        $.each(order.order_items, function(key, item){
                                            if(item.item_id == orderItemId){
                                                rows += '<tr>';
                                                rows += '<td>' + item.item_id + '</td>';
                                                rows += '<td>' + item.nama_item + '</td>';
                                                rows += '<td>' + item.satuan + '</td>';
                                                rows += '<td>' + item.jumlah_item + '</td>';
                                                rows += '<td>' + item.order_id + '</td>';
                                                rows += '</tr>';
                                            }
                                        });
                                    });
                                    $('#itemOrderCustomer tbody').html(rows);
                                } else {
                                    $('#itemOrderCustomer').slideUp();
                                }
                            }
                        });
                    }        
                    }
                });
            }
        });
    });
</script>

<!-- JS Spesific Page -->
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush
@endsection