$(document).ready(function () {
    $("#order_id").change(function () {
        var orderId = $(this).val();
        var customerId = $(this).find("option:selected").data("customer_id");
        if (orderId) {
            $.ajax({
                url: "/dashboard/logistik-harians/getOrder/" + orderId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var selectItemId = $("#selectItemId");
                    selectItemId.html(
                        "<option selected disabled>Pilih Item</option>"
                    );
                    if (data.length > 0) {
                        var options = "";
                        $.each(data[0].order_items, function (key, item) {
                            options +=
                                '<option value="' +
                                item.item_id +
                                '">' +
                                item.item_id +
                                " | " +
                                item.nama_item +
                                "</option>";
                        });
                        selectItemId.append(options);

                        $("#orderItemsTable").slideDown();
                        $('#biodataCustomer').slideDown();
                        var rows = "";
                        $.each(data[0].order_items, function (key, item) {
                            rows += "<tr>";
                            rows += "<td>" + item.item_id + "</td>";
                            rows += "<td>" + item.nama_item + "</td>";
                            rows += "<td>" + item.jumlah_item + "</td>";
                            rows += "</tr>";
                        });
                        $("#orderItemsTable tbody").html(rows);
                        $('#customerIdInfo').text(data[0].customer_id);
                        $('#customerNamaInfo').text(data[0].nama_customer);
                        $('#customerPerusahaanInfo').text((data[0].badan_hukum?? '-') +' '+ (data[0].nama_perusahaan??' '));
                        $('#customerProyekInfo').text(data[0].nama_proyek);
                        $('#customerAlamatKirimInfo').text(data[0].alamat_kirim);
                    } else {
                        $("#orderItemsTable").slideUp();
                        $('#biodataCustomer').slideUp();
                    }
                },
            });
        } else {
            $("#orderItemsTable").slideUp();
            $("#itemOrderLogistik").slideUp();
            $('#biodataCustomer').slideUp();
            $("#selectItemId").html(
                "<option selected disabled>Pilih Item</option>"
            );
        }

        if (customerId) {
            $.ajax({
                url:
                    "/dashboard/logistik-harians/getCustomerOrders/" +
                    customerId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $("#customerOrderTable").slideDown();
                        var rows = "";
                        $.each(data[0].orders, function (key, item) {
                            rows += "<tr>";
                            rows += "<td>" + item.customer_id + "</td>";
                            rows += "<td>" + item.order_id + "</td>";
                            rows += "<td>" + "Aktif" + "</td>";
                            rows += "</tr>";
                        });
                        $("#customerOrderTable tbody").html(rows);
                    } else {
                        $("#customerOrderTable").slideUp();
                    }
                },
            });
        } else {
            $("#customerOrderTable").slideUp();
            $("#itemOrderCustomer").slideUp();
            $("#jumlah_item").val("");
            $("#satuan").val("");
        }
    });

    $("#selectItemId").change(function () {
        var orderItemId = $(this).val();
        var customerId = $("#order_id")
            .find("option:selected")
            .data("customer_id");
        var orderId = $("#order_id").val();
        if (orderId) {
            $.ajax({
                url: "/dashboard/logistik-harians/getOrderItem/" + orderId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var itemId = null;
                    $.each(data, function (key, item) {
                        if (item.item_id == orderItemId) {
                            itemId = item.item_id;
                            $("#jumlah_item").val(item.jumlah_item);
                            $("#satuan").val(item.satuan);
                        }
                    });

                    if (itemId != null) {
                        $.ajax({
                            url: '/dashboard/logistik-harians/getLogistikHarians/' + orderId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                if (data.length > 0) {
                                $("#itemOrderLogistik").slideDown();
                                var rows = "";
                                $.each(data, function(key, item) {
                                    if(item.logistik.item_id == itemId){
                                        rows += "<tr>";
                                        rows += "<td>" + item.logistik.item_id + "</td>";
                                        rows += "<td>" + item.baik + "</td>";
                                        rows += "<td>" + item.x_ringan + "</td>";
                                        rows += "<td>" + item.x_berat + "</td>";
                                        rows += "<td>" + item.jumlah_item + "</td>";
                                        rows += "<td>" + item.status_logistik.nama_status + "</td>";
                                        rows += "<td>" + item.order_id + "</td>";
                                        rows += "</tr>";
                                    }
                                });
                                $("#itemOrderLogistik tbody").html(rows);
                            }else {
                                $("#itemOrderLogistik").slideUp();
                            }
                            }
                        });

                        $.ajax({
                            url:
                                "/dashboard/logistik-harians/getCustomerOrders/" +
                                customerId,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                if (data.length > 0) {
                                    $("#itemOrderCustomer").slideDown();
                                    var rows = "";
                                    $.each(
                                        data[0].orders,
                                        function (key, order) {
                                            $.each(
                                                order.order_items,
                                                function (key, item) {
                                                    if (
                                                        item.item_id ==
                                                        orderItemId
                                                    ) {
                                                        rows += "<tr>";
                                                        rows +=
                                                            "<td>" +
                                                            item.item_id +
                                                            "</td>";
                                                        rows +=
                                                            "<td>" +
                                                            item.nama_item +
                                                            "</td>";
                                                        rows +=
                                                            "<td>" +
                                                            item.satuan +
                                                            "</td>";
                                                        rows +=
                                                            "<td>" +
                                                            item.jumlah_item +
                                                            "</td>";
                                                        rows +=
                                                            "<td>" +
                                                            item.order_id +
                                                            "</td>";
                                                        rows += "</tr>";
                                                    }
                                                }
                                            );
                                        }
                                    );
                                    $("#itemOrderCustomer tbody").html(rows);
                                } else {
                                    $("#itemOrderCustomer").slideUp();
                                }
                            },
                        });
                    }
                },
            });
        }
    });
});
