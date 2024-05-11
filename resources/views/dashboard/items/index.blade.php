@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Item</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Item</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Semua Item
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.items.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Item</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Item Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>ID <span data-toggle="tooltip" title="Kode Customer"><i class="fas fa-question-circle"></i></span></th>
                            <th>Nama Item</th>
                            <th>Harga Sewa</th>
                            <th>Satuan Waktu</th>
                            <th>Harga Barang</th>
                            <th>Keterangan</th>
                            <th>Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->item_id }}</td>
                            <td>{{ $item->nama_item }}</td>
                            <td>Rp {{ number_format($item->harga_sewa,2,",",".") }}</td>
                            <td>{{ $item->satuan_waktu }}</td>
                            <td>Rp {{ number_format($item->harga_barang,2,",",".") }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <a href="{{ route('dashboard.items.edit', ['item' => $item->item_id]) }}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $items->links() }}
            </nav>
        </div>
    </div>
</div>

@endsection