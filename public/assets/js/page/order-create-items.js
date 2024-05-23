$(document).ready(function() {
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    function updateDeleteButtonVisibility() {
        $('.delete-form-btn').show(); // Tombol delete selalu terlihat
    }

    updateDeleteButtonVisibility(); // Panggil fungsi ini saat halaman pertama kali dimuat

    // Fungsi untuk menambah formulir item baru
    $("#add-form-item").click(function() {
        var newItemForm = $(".form-item").first().clone(); // Salin formulir item pertama
        newItemForm.find('select,input').val(''); // Reset nilai input/select di formulir baru
        newItemForm.find('.jumlah-item').val(1);
        newItemForm.find('.waktu').val(1);
        $("#form-container").append(newItemForm); // Tambahkan formulir baru ke dalam kontainer
        
        updateDeleteButtonVisibility();
    });

    // Fungsi untuk menghapus formulir item
    $(document).on("click", ".delete-form-btn", function() {
        var formsCount = $('.form-item').length;
        if (formsCount > 1) { // Pastikan setidaknya ada satu formulir tersisa
            $(this).closest('.form-item').remove(); // Hapus formulir
        } else {
            iziToast.error({
                title: 'Tidak Bisa Dihapus',
                message: 'Minimal 1 pemesanan item pada Order',
                position: 'topRight'
            });
        }
        
        updateDeleteButtonVisibility();
    });

    // Fungsi untuk mengatur nilai field berdasarkan pilihan item
    $(document).on("change", ".select-item", function() {
        let container = $(this).closest('.form-item');
        let harga_sewa = $(this).find('option:selected').data('harga_sewa');
        let satuan_waktu = $(this).find('option:selected').data('satuan_waktu');
        let satuan_item = $(this).find('option:selected').data('satuan_item');
        let jumlah_item = container.find('.jumlah-item').val();

        container.find('.harga-sewa').val(harga_sewa);
        container.find('.satuan-waktu').val("Per " + satuan_waktu );
        container.find('.satuan-item').val(satuan_item);
        if(satuan_waktu == 'Bulan'){
            container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa) * parseInt(jumlah_item)));
        }else{
            container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa*30) * parseInt(jumlah_item)));
        }
    });

    $(document).on("change", ".jumlah-item", function(){
        let container = $(this).closest('.form-item');
        let jumlah_item = container.find('.jumlah-item').val();
        let harga_sewa = container.find('.harga-sewa').val();

        container.find('.jumlah').val(formatRupiah(parseInt(harga_sewa) * parseInt(jumlah_item)));
    });
});