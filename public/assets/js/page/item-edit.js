new Cleave('#harga_sewa', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
});

new Cleave('#harga_barang', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
});

new Cleave('#x_ringan', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
});

$(document).ready(function(){
    // Set total_log to zero on page load
    $('#total_log').val(0);

    // Set total_stock to its initial value on page load
    let initial_total_stock = $('#total_stock').data('initial');
    $('#total_stock').val(initial_total_stock);

    $("#total_log").change(function(){
        // Ambil nilai dari input dan parse ke integer, default ke 0 jika NaN
        let total_log = parseInt($(this).val()) || 0;
        let total_stock = parseInt($('#total_stock').data('initial')) || 0;


        // Jumlahkan total_log dan total_stock, lalu isi input total_stock dengan hasilnya
        let new_total_stock = total_log + total_stock;

        $('#total_stock').val(new_total_stock);
    });
});