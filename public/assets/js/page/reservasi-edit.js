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
    $("#tanggal_reservasi").attr("placeholder", "dd/mm/yyyy");
    $("#tanggal_reservasi").on("apply.daterangepicker", function (ev, picker) {
        $(this).val(picker.startDate.format("DD/MM/YYYY"));
    });
    $("#tanggal_reservasi").on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
    });

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

        // Validasi reservasi item
        let valid = true;
        $('.select-item').each(function() {
            if ($(this).val() === null || $(this).val() === 'Pilih Item') {
                valid = false;
            }
        });
    
        if (!valid) {
            e.preventDefault();
            iziToast.error({
                title: 'Reservasi Item',
                message: 'Reservasi Item harus diisi!',
                position: 'topRight'
            });
            return; // Menghentikan eksekusi lebih lanjut jika validasi gagal
        }

        e.preventDefault(); // Mencegah submit form secara default
        Swal.fire({
            title: 'Anda yakin untuk mengedit?',
            text: "Data yang diubah akan berpengaruh ke database",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, submit!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.currentTarget.submit(); // Melanjutkan submit form jika user mengkonfirmasi
            }
        });
        
    });
});
