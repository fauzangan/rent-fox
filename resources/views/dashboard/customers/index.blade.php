@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
  <h1>Manajemen Customer</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
    <div class="breadcrumb-item">Manajemen Customer</div>
  </div>
</div>

<div class="section-body">
  <div class="row justify-content-between my-3">
    <div class="col">
      <div class="section-title my-0">
        Data Semua Customer
      </div>
    </div>
    <div class="col-md-auto">
      <a href="{{ route('dashboard.customers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Customer</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h4>Customer Table</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-md">
          <thead>
            <tr>
              <th>ID <span data-toggle="tooltip" title="Kode Customer"><i class="fas fa-question-circle"></i></span></th>
              <th>Nama</th>
              <th>Identitas</th>
              <th>No. Identitas</th>
              <th>Status</th>
              <th>Bonafidity</th>
              <th>Hk.</th>
              <th>Perusahaan</th>
              <th>Handle</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
            <tr>
              <td>{{ $customer->customer_id }}</td>
              <td>{{ $customer->nama }}</td>
              <td>{{ $customer->jenis_identitas }}</td>
              <td>{{ $customer->nomor_identitas }}</td>
              <td>
                @if($customer->bit_active)
                <div class="badge badge-success">Aktif</div>
                @else
                <div class="badge badge-danger">Non Aktif</div>
                @endif
              </td>
              <td>{{ $customer->bonafidity }}</td>
              @if($customer->perusahaan != null)
              <td>{{ $customer->perusahaan->badan_hukum }}</td>
              <td>{{ $customer->perusahaan->nama }}</td>
              @else
              <td>-</td>
              <td>-</td>
              @endif
              <td>
                {{-- <button class="detail-button btn btn-info" data-id="{{ $customer->customer_id}}"
                  id="detail-button">Detail</button> --}}
                <button class="btn btn-info" id="detail-button" data-id={{ $customer->customer_id }}>Detail</button>
                <a href="{{ route('dashboard.customers.edit', ['customer' => $customer->customer_id]) }}"
                  class="btn btn-warning">Edit</a>
                <a href="{{ route('dashboard.customers.delete', ['customer' => $customer->customer_id]) }}"
                  class="btn btn-danger" data-confirm-delete="true">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-right">
      <nav class="d-inline-block">
        {{ $customers->links() }}
      </nav>
    </div>
  </div>
</div>

@push('style')
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">Detail Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Menampilkan detail customer -->
        <div class="row">
          <div class="col">
            <h5>Biodata Pribadi</h5>
            <p><strong>Nama:</strong> <span id="customer-name"></span></p>
            <p><strong>Jenis Identitas:</strong> <span id="customer-jenis-identitas"></span></p>
            <p><strong>Identitas Berlaku:</strong> <span id="customer-identitas-berlaku"></span></p>
            <p><strong>Nomor Identitas:</strong> <span id="customer-nomor-identitas"></span></p>
            <p><strong>Jabatan:</strong> <span id="customer-jabatan"></span></p>
            <p><strong>Alamat:</strong> <span id="customer-alamat"></span></p>
            <p><strong>Kota:</strong> <span id="customer-kota"></span></p>
            <p><strong>Provinsi:</strong> <span id="customer-provinsi"></span></p>
            <p><strong>Telepon:</strong> <span id="customer-telp"></span></p>
            <p><strong>Fax:</strong> <span id="customer-fax"></span></p>
            <p><strong>Handphone:</strong> <span id="customer-handphone"></span></p>
            <p><strong>Bonafidity:</strong> <span id="customer-bonafidity"></span></p>
            <p><strong>Dibuat Pada:</strong> <span id="customer-created-at"></span></p>
            <p><strong>Diupdate Pada:</strong> <span id="customer-updated-at"></span></p>
          </div>
          <div class="col">
            <h5>Biodata Perusahaan</h5>
            <p><strong>Perusahaan: </strong><span id="customer-perusahaan-nama"></span></p>
            <p><strong>Provinsi: </strong><span id="customer-perusahaan-provinsi"></span></p>
            <p><strong>Kota: </strong><span id="customer-perusahaan-kota"></span></p>
            <p><strong>Alamat: </strong><span id="customer-perusahaan-alamat"></span></p>
            <p><strong>Telp: </strong><span id="customer-perusahaan-telp"></span></p>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<script>
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
</script>

@endsection