$(document).ready(function() {
    // Fungsi untuk menangani klik tombol detail
    $(document).on('click', '#detail-button', function() {
        var customerId = $(this).data('id'); // Ambil ID dari data-id atribut pada tombol
        // Buat permintaan AJAX ke server untuk mengambil detail customer
        $.ajax({
            url: '/dashboard/customers/detail/' + customerId,
            method: 'GET',
            success: function(data) {
                // Memperbarui konten modal dengan detail customer
                console.log(data)
                $('#customer-name').text(data.nama || '-');
                $('#customer-jenis-identitas').text(data.jenis_identitas || '-');
                $('#customer-identitas-berlaku').text(data.identitas_berlaku || '-');
                $('#customer-nomor-identitas').text(data.nomor_identitas || '-');
                $('#customer-jabatan').text(data.jabatan || '-');
                $('#customer-alamat').text(data.alamat || '-');
                $('#customer-kota').text(data.kota || '-');
                $('#customer-provinsi').text(data.provinsi || '-');
                $('#customer-telp').text(data.telp || '-');
                $('#customer-fax').text(data.fax || '-');
                $('#customer-handphone').text(data.handphone || '-');
                $('#customer-bonafidity').text(data.bonafidity || '-');
                $('#customer-created-at').text(new Date(data.created_at).toLocaleDateString());
                $('#customer-updated-at').text(new Date(data.updated_at).toLocaleDateString());

                // Data Perusahaan
                if(data.perusahaan !== null){
                    $('#customer-perusahaan-nama').text(data.perusahaan.badan_hukum +' '+ data.perusahaan.nama || '-');
                    $('#customer-perusahaan-provinsi').text(data.perusahaan.provinsi || '-');
                    $('#customer-perusahaan-kota').text(data.perusahaan.kota || '-');
                    $('#customer-perusahaan-alamat').text(data.perusahaan.alamat || '-');
                    $('#customer-perusahaan-telp').text(data.perusahaan.telp || '-');
                }else{
                    $('#customer-perusahaan-nama').text('-');
                    $('#customer-perusahaan-provinsi').text('-');
                    $('#customer-perusahaan-kota').text('-');
                    $('#customer-perusahaan-alamat').text('-');
                    $('#customer-perusahaan-telp').text('-');
                }

                // Tampilkan modal
                $('#customerModal').appendTo("body").modal('show');
            },
            error: function() {
                alert('Gagal mengambil data customer.');
            }
        });
    });
});