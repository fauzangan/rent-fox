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
              <th>ID</th>
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
              <td>{{ $customer->bit_active }}</td>
              <td>{{ $customer->bonafidity }}</td>
              @if($customer->perusahaan != null)
              <td>{{ $customer->perusahaan->badanHukum->name }}</td>
              <td>{{ $customer->perusahaan->nama }}</td>
              @else
              <td>-</td>
              <td>-</td>
              @endif
              <td>test</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-right">
      <nav class="d-inline-block">
        pagination
      </nav>
    </div>
  </div>
</div>
@endsection