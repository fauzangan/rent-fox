$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    // Fungsi untuk menghapus nilai dari elemen input dan textarea
    function clearCompanyForm() {
        $("#company-form").find("input, textarea").val("");
    }
    function clearIdBerlakuForm() {
        $("#identitas_berlaku_form").find("input").val("");
    }

    // Fungsi untuk mengatur status aktif dari elemen input dan textarea
    function setCompanyFormEnabled(enabled) {
        $("#company-form")
            .find("input, select, textarea")
            .prop("disabled", !enabled);
    }
    function setIdBerlakuFormEnabled(enabled) {
        $("#identitas_berlaku_form").find("input").prop("disabled", !enabled);
    }

    // Mendengarkan perubahan pada elemen select "is_perusahaan"
    $("#is_perusahaan").on("change", function () {
        var selectedValue = $(this).val();

        // Menampilkan atau menyembunyikan form perusahaan berdasarkan nilai yang dipilih
        if (selectedValue == "1") {
            // Jika opsi "Perusahaan" dipilih, tampilkan form perusahaan dan aktifkan input
            $("#company-form").slideDown();
            setCompanyFormEnabled(true);
        } else {
            // Jika opsi "Diri Sendiri" dipilih, sembunyikan form perusahaan, nonaktifkan input, dan hapus nilai input
            $("#company-form").slideUp();
            setCompanyFormEnabled(false);
            clearCompanyForm();
        }
    });
    // Trigger change event untuk memastikan visibilitas saat halaman dimuat
    $("#is_perusahaan").trigger("change");

    $("#jenis_identitas").on("change", function () {
        var selectedValue = $(this).val();

        if (selectedValue == "SIM") {
            $("#identitas_berlaku_form").slideDown();
            setIdBerlakuFormEnabled(true);
        } else {
            $("#identitas_berlaku_form").slideUp();
            setIdBerlakuFormEnabled(false);
            clearIdBerlakuForm();
        }
    });

    $("#jenis_identitas").trigger("change");

    new Cleave("#identitas_berlaku", {
        date: true,
        datePattern: ["d", "m", "Y"],
    });
    
    new Cleave("#handphones", {
        phone: true,
        phoneRegionCode: "ID",
    });
    
    new Cleave("#telp", {
        phone: true,
        phoneRegionCode: "ID",
    });
    
    new Cleave("#telp_perusahaan", {
        phone: true,
        phoneRegionCode: "ID",
    });
});


