$(document).ready(function () {

    // Fungsi untuk menangani perubahan pada order_id
    $("#order_id").change(function () {
        var orderId = $(this).val();
        var customerId = $(this).find("option:selected").data("customer_id");

        if (orderId) {
            getOrderDetails(orderId);
        } else {
            clearOrderDetails();
        }

        if (customerId) {
            getCustomerOrders(customerId);
        } else {
            clearCustomerOrders();
        }
    });

    // Fungsi untuk menangani perubahan pada selectItemId
    $("#selectItemId").change(function () {
        var orderItemId = $(this).val();
        var customerId = $("#order_id").find("option:selected").data("customer_id");
        var orderId = $("#order_id").val();

        if (orderId) {
            getOrderItemDetails(orderId, orderItemId, customerId);
        }
    });

    // Fungsi untuk mendapatkan detail order berdasarkan orderId
    function getOrderDetails(orderId) {
        $.ajax({
            url: "/dashboard/logistik-harians/getOrder/" + orderId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if(response.success){
                    populateOrderItems(response.orderItems);
                    displayCustomerInfo(
                        response.customerId, 
                        response.namaCustomer, 
                        response.badanHukumPerusahaan, 
                        response.namaPerusahaan, 
                        response.proyek, 
                        response.alamatKirim
                    );
                } else {
                    iziToast.error({
                        title: 'Gagal Mengambil Order Data',
                        message: `${response.message}`,
                        position: 'topRight'
                    });
                }
            }
        });
    }

    // Fungsi untuk mengosongkan detail order
    function clearOrderDetails() {
        $("#orderItemsTable").slideUp();
        $("#itemOrderLogistik").slideUp();
        $('#biodataCustomer').slideUp();
        $("#selectItemId").html("<option selected disabled>Pilih Item</option>");
    }

    // Fungsi untuk mendapatkan order customer berdasarkan customerId
    function getCustomerOrders(customerId) {
        $.ajax({
            url: "/dashboard/logistik-harians/getCustomerOrders/" + customerId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if(response.success){
                    populateCustomerOrders(response.customerOrders);
                } else {
                    iziToast.error({
                        title: 'Gagal Mengambil Customer Order Data',
                        message: `${response.message}`,
                        position: 'topRight'
                    });
                }
            }
        });
    }

    // Fungsi untuk mengosongkan order customer
    function clearCustomerOrders() {
        $("#customerOrderTable").slideUp();
        $("#itemOrderCustomer").slideUp();
        $("#jumlah_item").val("");
        $("#satuan").val("");
    }

    // Fungsi untuk mendapatkan detail item order berdasarkan orderId dan orderItemId
    function getOrderItemDetails(orderId, orderItemId, customerId) {
        $.ajax({
            url: "/dashboard/logistik-harians/getOrderItem/" + orderId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                var item = data.find(item => item.item_id == orderItemId);
                if (item) {
                    $("#jumlah_item").val(item.jumlah_item);
                    $("#satuan").val(item.satuan);
                    getLogistikHarians(orderId, item.item_id);
                    getCustomerOrderItems(customerId, orderItemId);
                }
            }
        });
    }

    // Fungsi untuk mendapatkan logistik harian berdasarkan orderId dan itemId
    function getLogistikHarians(orderId, itemId) {
        $.ajax({
            url: '/dashboard/logistik-harians/getLogistikHarians/' + orderId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length > 0) {
                    populateLogistikHarians(data, itemId);
                } else {
                    $("#itemOrderLogistik").slideUp();
                }
            }
        });
    }

    // Fungsi untuk mendapatkan item order customer berdasarkan customerId dan orderItemId
    function getCustomerOrderItems(customerId, orderItemId) {
        $.ajax({
            url: "/dashboard/logistik-harians/getCustomerOrders/" + customerId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    populateCustomerOrderItems(response.customerOrders, orderItemId);
                } else {
                    $("#itemOrderCustomer").slideUp();
                }
            }
        });
    }

    // Fungsi untuk menampilkan item order pada dropdown select
    function populateOrderItems(orderItems) {
        var selectItemId = $("#selectItemId");
        selectItemId.html("<option selected disabled>Pilih Item</option>");
        if (orderItems.length > 0) {
            var options = orderItems.map(item => 
                `<option value="${item.item_id}">${item.item_id} | ${item.nama_item}</option>`
            ).join('');
            selectItemId.append(options);

            $("#orderItemsTable").slideDown();
            $('#biodataCustomer').slideDown();

            var rows = orderItems.map(item => 
                `<tr>
                    <td>${item.item_id}</td>
                    <td>${item.nama_item}</td>
                    <td>${item.jumlah_item}</td>
                </tr>`
            ).join('');
            $("#orderItemsTable tbody").html(rows);
        } else {
            $("#orderItemsTable").slideUp();
            $('#biodataCustomer').slideUp();
        }
    }

    // Fungsi untuk menampilkan informasi customer
    function displayCustomerInfo(customerId, namaCustomer, badanHukumPerusahaan, namaPerusahaan, proyek, alamatKirim) {
        $('#customerIdInfo').val(customerId);
        $('#customerNamaInfo').val(namaCustomer);
        $('#customerPerusahaanInfo').val((badanHukumPerusahaan ?? '-') + ' ' + (namaPerusahaan ?? ' '));
        $('#customerProyekInfo').val(proyek);
        $('#customerAlamatKirimInfo').val(alamatKirim);
    }

    // Fungsi untuk menampilkan order customer pada tabel
    function populateCustomerOrders(orders) {
        if (orders.length > 0) {
            $("#customerOrderTable").slideDown();
            var rows = orders.map(order => 
                `<tr>
                    <td>${order.customer_id}</td>
                    <td>${order.order_id}</td>
                    <td>Aktif</td>
                </tr>`
            ).join('');
            $("#customerOrderTable tbody").html(rows);
        } else {
            $("#customerOrderTable").slideUp();
        }
    }

    // Fungsi untuk menampilkan logistik harian pada tabel
    function populateLogistikHarians(logistikHarians, itemId) {
        $("#itemOrderLogistik").slideDown();
        var rows = logistikHarians.filter(item => item.logistik.item_id == itemId).map(item => 
            `<tr>
                <td>${item.logistik.item_id}</td>
                <td>${item.baik}</td>
                <td>${item.x_ringan}</td>
                <td>${item.x_berat}</td>
                <td>${item.jumlah_item}</td>
                <td>${item.status_logistik.nama_status}</td>
                <td>${item.order_id}</td>
            </tr>`
        ).join('');
        $("#itemOrderLogistik tbody").html(rows);
    }

    // Fungsi untuk menampilkan item order customer pada tabel
    function populateCustomerOrderItems(orders, orderItemId) {
        if (orders.length > 0) {
            $("#itemOrderCustomer").slideDown();
            var rows = orders.flatMap(order => 
                order.order_items.filter(item => item.item_id == orderItemId).map(item => 
                    `<tr>
                        <td>${item.item_id}</td>
                        <td>${item.nama_item}</td>
                        <td>${item.satuan}</td>
                        <td>${item.jumlah_item}</td>
                        <td>${item.order_id}</td>
                    </tr>`
                )
            ).join('');
            $("#itemOrderCustomer tbody").html(rows);
        } else {
            $("#itemOrderCustomer").slideUp();
        }
    }
});