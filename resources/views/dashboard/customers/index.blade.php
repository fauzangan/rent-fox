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
      <a href="{{ route('dashboard.customers.create') }}" class="btn btn-primary">Tambah Customer</a>
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
              <th>ID <span data-toggle="tooltip" title="Id Customer"><i class="fas fa-question-circle"></i></span></th>
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
              <td>{{ $customer->perusahaan->badanHukum->name }}</td>
              <td>{{ $customer->perusahaan->nama }}</td>
              @else
              <td>-</td>
              <td>-</td>
              @endif
              <td>
                <a href="{{ route('dashboard.customers.detail', ['customer' => $customer->customer_id]) }}"
                  class="btn btn-info">Detail</a>
                <a href="{{ route('dashboard.customers.edit', ['customer' => $customer->customer_id]) }}"
                  class="btn btn-warning">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
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
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}">
</script>
<script>
  @if(session('notification'))
      // Ambil data notifikasi dari session
      var notification = @json(session('notification'));
  
      // Tampilkan notifikasi dengan iziToast
      iziToast.success({
          title: notification.title,
          message: notification.message,
          position: 'bottomRight', // Posisi notifikasi
      });
  @endif
  </script>
@endsection