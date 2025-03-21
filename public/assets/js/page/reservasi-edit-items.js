$(document).ready(function() {
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    function updateDeleteButtonVisibility() {
        // Tombol delete selalu terlihat
        $('.delete-form-btn').show();
    }

    function checkForDuplicateItems() {
        let itemCodes = [];
        let hasDuplicate = false;
        $('.select-item').each(function() {
            let itemCode = $(this).val();
            if (itemCodes.includes(itemCode)) {
                hasDuplicate = true;
                return false; // keluar dari each loop
            }
            itemCodes.push(itemCode);
        });
        return hasDuplicate;
    }

    function showDuplicateItemToast() {
        iziToast.error({
            title: 'Item Duplikat',
            message: 'Terdapat item yang duplikat pada formulir!',
            position: 'topRight'
        });
    }

    function initializeFormFields(container) {
        let selectItem = container.find('.select-item');
        let hargaSewa = selectItem.find('option:selected').data('harga_sewa');
        let satuanWaktu = selectItem.find('option:selected').data('satuan_waktu') || '';
        let satuanItem = selectItem.find('option:selected').data('satuan_item');
        let jumlahItem = container.find('.jumlah-item').val();

        container.find('.harga-sewa').val(hargaSewa);
        container.find('.satuan-waktu').val((satuanWaktu) ? ("Per " + satuanWaktu) : '');
        container.find('.satuan-item').val(satuanItem);
        if(satuanWaktu == 'Bulan'){
            container.find('.jumlah').val(formatRupiah(parseInt(hargaSewa) * parseInt(jumlahItem)));
        } else {
            container.find('.jumlah').val(formatRupiah(parseInt(hargaSewa * 30) * parseInt(jumlahItem)));
        }
    }

    updateDeleteButtonVisibility(); // Panggil fungsi ini saat halaman pertama kali dimuat

    // Inisialisasi field pada form yang sudah ada
    $(".form-item").each(function() {
        initializeFormFields($(this));
    });

    // Fungsi untuk menambah formulir item baru
    $("#add-form-item").click(function() {
        var newItemForm = $(".form-item").first().clone(); // Salin formulir item pertama
        newItemForm.find('select,input').val(''); // Reset nilai input/select di formulir baru
        newItemForm.find('.jumlah-item').val(1);
        newItemForm.find('.waktu').val(1);
        $("#form-container").append(newItemForm); // Tambahkan formulir baru ke dalam kontainer

        initializeFormFields(newItemForm); // Inisialisasi field pada formulir baru

        if (checkForDuplicateItems()) {
            newItemForm.remove(); // Hapus form jika duplikat ditemukan
            showDuplicateItemToast();
        }
        
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
        let hargaSewa = $(this).find('option:selected').data('harga_sewa');
        let satuanWaktu = $(this).find('option:selected').data('satuan_waktu');
        let satuanItem = $(this).find('option:selected').data('satuan_item');
        let jumlahItem = container.find('.jumlah-item').val();

        container.find('.harga-sewa').val(hargaSewa);
        container.find('.satuan-waktu').val("Per " + satuanWaktu);
        container.find('.satuan-item').val(satuanItem);
        if(satuanWaktu == 'Bulan'){
            container.find('.jumlah').val(formatRupiah(parseInt(hargaSewa) * parseInt(jumlahItem)));
        } else {
            container.find('.jumlah').val(formatRupiah(parseInt(hargaSewa * 30) * parseInt(jumlahItem)));
        }

        if (checkForDuplicateItems()) {
            $(this).val(''); // Reset the value if duplicate found
            container.find('.harga-sewa').val('')
            container.find('.jumlah').val('')
            container.find('.satuan-waktu').val('');
            container.find('.satuan-item').val('');
            showDuplicateItemToast();
        }
    });

    // Update jumlah ketika kuantitas berubah
    $(document).on("change", ".jumlah-item", function(){
        let container = $(this).closest('.form-item');
        let jumlahItem = container.find('.jumlah-item').val();
        let hargaSewa = container.find('.harga-sewa').val();

        container.find('.jumlah').val(formatRupiah(parseInt(hargaSewa) * parseInt(jumlahItem)));
    });
});