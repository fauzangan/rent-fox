new Cleave("#jumlah_tagihan", {
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
});

new Cleave("#total_dp", {
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
});

new Cleave("#dp_1", {
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
});

new Cleave("#dp_2", {
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
});

new Cleave("#dp_3", {
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
});

$(document).ready(function () {
    $("#order_id").change(function () {
        let customer_id = $(this).find("option:selected").data("customer_id");
        let nama_customer = $(this)
            .find("option:selected")
            .data("nama_customer");
        let badan_hukum = $(this).find("option:selected").data("badan_hukum");
        let nama_perusahaan = $(this)
            .find("option:selected")
            .data("nama_perusahaan");
        let proyek = $(this).find("option:selected").data("proyek");

        // Isi nilai input dengan data customer yang dipilih
        $("#customer_id").val(customer_id);
        $("#nama_customer").val(nama_customer);
        $("#badan_hukum").val(badan_hukum);
        $("#nama_perusahaan").val(nama_perusahaan);
        $("#nama_proyek").val(proyek);
    });

    /* Pengaturan Tanggal Ditagihkan Input */
    $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").daterangepicker({
        locale: { format: "DD/MM/YYYY" },
        singleDatePicker: true,
        autoUpdateInput: false,
    });
    $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").attr(
        "placeholder",
        "dd/mm/yyyy"
    );
    $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY"));
        }
    );
    $("#tanggal_ditagihkan, #jatuh_tempo_1, #jatuh_tempo_2").on(
        "cancel.daterangepicker",
        function (ev, picker) {
            $(this).val("");
        }
    );

    /* Mencegah memasukan tanggal yang salah */
    $("form").on("submit", function (e) {
        let tanggalDitagihkan = $("#tanggal_ditagihkan").val();
        let jatuhTempo1 = $("#jatuh_tempo_1").val();
        let jatuhTempo2 = $("#jatuh_tempo_2").val();

        if (
            !moment(tanggalDitagihkan, "DD/MM/YYYY", true).isValid() ||
            !moment(jatuhTempo1, "DD/MM/YYYY", true).isValid() ||
            !moment(jatuhTempo2, "DD/MM/YYYY", true).isValid()
        ) {
            e.preventDefault();
            iziToast.error({
                title: "Input Tanggal Salah/Kosong",
                message:
                    "Tanggal tidak valid. Format yang benar adalah Hari/Bulan/Tahun.",
                position: "topRight",
            });
        }
    });

    // Fungsi untuk menghapus nilai dari elemen input dan textarea
    function clearDpForm() {
        $("#dp-form").find("input").val("");
    }

    // Fungsi untuk mengatur status aktif dari elemen input dp
    function setDpFormEnabled(enabled) {
        $("#dp-form").find("input").prop("disabled", !enabled);
    }

    // Mendengarkan perubahan pada elemen select "is_dp"
    $("#is_dp").on("change", function () {
        var selectedValue = $(this).val();

        // Menampilkan atau menyembunyikan form perusahaan berdasarkan nilai yang dipilih
        if (selectedValue == "1") {
            // Jika opsi "DP == Ya" dipilih, tampilkan form perusahaan dan aktifkan input
            $("#dp-form").slideDown();
            setDpFormEnabled(true);
        } else {
            // Jika opsi "DP == Tidak" dipilih, sembunyikan form perusahaan, nonaktifkan input, dan hapus nilai input
            $("#dp-form").slideUp();
            setDpFormEnabled(false);
            clearDpForm();
        }
    });
    // Trigger change event untuk memastikan visibilitas saat halaman dimuat
    $("#is_dp").trigger("change");
});
