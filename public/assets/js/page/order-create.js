$(document).ready(function(){

    /* Pengaturan Tanggal Ditagihkan Input */
    $("#tanggal_order, #tanggal_kirim").daterangepicker({
        locale: { format: "DD/MM/YYYY" },
        singleDatePicker: true,
        autoUpdateInput: false,
    });
    $("#tanggal_order, #tanggal_kirim").attr("placeholder","dd/mm/yyyy");
    $("#tanggal_order, #tanggal_kirim").on("apply.daterangepicker",
        function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY"));
        }
    );
    $("#tanggal_order, #tanggal_kirim").on("cancel.daterangepicker",
        function (ev, picker) {
            $(this).val("");
        }
    );

    /* Mencegah memasukan tanggal yang salah */
    $("form").on("submit", function (e) {
        let tanggalOrder = $("#tanggal_order").val();
        let tanggalKirim = $("#tanggal_kirim").val();

        if (!moment(tanggalOrder, "DD/MM/YYYY", true).isValid() || !moment(tanggalKirim, "DD/MM/YYYY", true).isValid()) 
        {
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
            e.preventDefault();
            iziToast.error({
                title: 'Item Order',
                message: 'Item Order harus diisi!',
                position: 'topRight'
            });
        }
    });


    // $("#customer_select").change(function(){
    //     let nama = $(this).find('option:selected').data('nama');
    //     let identitas_customer = $(this).find('option:selected').data('identitas_customer');
    //     let alamat = $(this).find('option:selected').data('alamat');
    //     let kota = $(this).find('option:selected').data('kota');
    //     let telp = $(this).find('option:selected').data('telp');
    //     let fax = $(this).find('option:selected').data('fax');
    //     let handphone = $(this).find('option:selected').data('handphone');
    //     let badan_hukum = $(this).find('option:selected').data('badan_hukum');
    //     let nama_perusahaan = $(this).find('option:selected').data('nama_perusahaan');
    //     let alamat_perusahaan = $(this).find('option:selected').data('alamat_perusahaan');
    //     let kota_perusahaan = $(this).find('option:selected').data('kota_perusahaan');
    //     let telp_perusahaan = $(this).find('option:selected').data('telp_perusahaan');
    //     let fax_perusahaan = $(this).find('option:selected').data('fax_perusahaan');
        
    //     // Isi nilai input dengan data customer yang dipilih
    //     $('#nama_customer').val(nama);
    //     $('#identitas_customer').val(identitas_customer);
    //     $('#alamat_customer').text(alamat);
    //     $('#kota_customer').val(kota);
    //     $('#telp_customer').val(telp);
    //     $('#fax_customer').val(fax);
    //     $('#handphone').val(handphone);
    //     $('#badan_hukum').val(badan_hukum);
    //     $('#nama_perusahaan').val(nama_perusahaan);
    //     $('#alamat_perusahaan').text(alamat_perusahaan);
    //     $('#kota_perusahaan').val(kota_perusahaan);
    //     $('#telp_perusahaan').val(telp_perusahaan);
    //     $('#fax_perusahaan').val(fax_perusahaan);
    // });
    
    // Fungsi untuk mengisi data customer
    function fillCustomerData() {
        let selectedOption = $("#customer_select").find('option:selected');
        
        let nama = selectedOption.data('nama');
        let identitas_customer = selectedOption.data('identitas_customer');
        let alamat = selectedOption.data('alamat');
        let kota = selectedOption.data('kota');
        let telp = selectedOption.data('telp');
        let fax = selectedOption.data('fax');
        let handphone = selectedOption.data('handphone');
        let badan_hukum = selectedOption.data('badan_hukum');
        let nama_perusahaan = selectedOption.data('nama_perusahaan');
        let alamat_perusahaan = selectedOption.data('alamat_perusahaan');
        let kota_perusahaan = selectedOption.data('kota_perusahaan');
        let telp_perusahaan = selectedOption.data('telp_perusahaan');
        let fax_perusahaan = selectedOption.data('fax_perusahaan');
        
        // Isi nilai input dengan data customer yang dipilih
        $('#nama_customer').val(nama);
        $('#identitas_customer').val(identitas_customer);
        $('#alamat_customer').text(alamat);
        $('#kota_customer').val(kota);
        $('#telp_customer').val(telp);
        $('#fax_customer').val(fax);
        $('#handphone').val(handphone);
        $('#badan_hukum').val(badan_hukum);
        $('#nama_perusahaan').val(nama_perusahaan);
        $('#alamat_perusahaan').text(alamat_perusahaan);
        $('#kota_perusahaan').val(kota_perusahaan);
        $('#telp_perusahaan').val(telp_perusahaan);
        $('#fax_perusahaan').val(fax_perusahaan);
    }

    // Jalankan fungsi saat halaman dimuat
    fillCustomerData();

    // Event listener untuk select change
    $("#customer_select").change(function() {
        fillCustomerData();
    });
});