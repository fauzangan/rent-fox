@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Tambah Peran Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.hak-akses.index') }}">Manajemen Peran</a></div>
        <div class="breadcrumb-item">Tambah Peran</div>
    </div>
</div>

<div class="section-body">
    <div class="card px-3 mx-xl-5">
        <div class="card-header">
            <h4>Formulir Tambah Peran Pengguna</h4>
        </div>
        <form action="{{ route('dashboard.hak-akses.create') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row ">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Peran Pengguna</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-title d-flex justify-content-center mt-0">
                    <h5>Set Up Hak Akses</h5>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Customer</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-customers">
                                <label class="form-check-label">
                                    Melihat Customer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-customers">
                                <label class="form-check-label">
                                    Menambah Customer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-customers">
                                <label class="form-check-label">
                                    Mengedit Customer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-customers">
                                <label class="form-check-label">
                                    Menghapus Customer
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Order</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-orders">
                                <label class="form-check-label">
                                    Melihat Order
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-orders">
                                <label class="form-check-label">
                                    Menambah Order
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-orders">
                                <label class="form-check-label">
                                    Mengedit Order
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-orders">
                                <label class="form-check-label">
                                    Menghapus Order
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Tagihan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-tagihans">
                                <label class="form-check-label">
                                    Melihat Tagihan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-tagihans">
                                <label class="form-check-label">
                                    Menambah Tagihan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-tagihans">
                                <label class="form-check-label">
                                    Mengedit Tagihan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-tagihans">
                                <label class="form-check-label">
                                    Menghapus tagihan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Logistik Harian</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-logistik-harians">
                                <label class="form-check-label">
                                    Melihat Logistik Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-logistik-harians">
                                <label class="form-check-label">
                                    Menambah Logistik Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-logistik-harians">
                                <label class="form-check-label">
                                    Mengedit Logistik Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-logistik-harians">
                                <label class="form-check-label">
                                    Menghapus Logistik Harian
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Logistik Total</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-logistik-totals">
                                <label class="form-check-label">
                                    Melihat Logistik Total
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-logistik-totals">
                                <label class="form-check-label">
                                    Menambah Logistik Total
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-logistik-totals">
                                <label class="form-check-label">
                                    Mengedit Logistik Total
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-logistik-totals">
                                <label class="form-check-label">
                                    Menghapus Logistik Total
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Buku Harian</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-buku-harians">
                                <label class="form-check-label">
                                    Melihat Buku Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-buku-harians">
                                <label class="form-check-label">
                                    Menambah Buku Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-buku-harians">
                                <label class="form-check-label">
                                    Mengedit Buku Harian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-buku-harians">
                                <label class="form-check-label">
                                    Menghapus Buku Harian
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Items</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-items">
                                <label class="form-check-label">
                                    Melihat Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-items">
                                <label class="form-check-label">
                                    Menambah Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-items">
                                <label class="form-check-label">
                                    Mengedit Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-items">
                                <label class="form-check-label">
                                    Menghapus Items
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Category Items</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-category-items">
                                <label class="form-check-label">
                                    Melihat Category Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-category-items">
                                <label class="form-check-label">
                                    Menambah Category Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-category-items">
                                <label class="form-check-label">
                                    Mengedit Category Items
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-category-items">
                                <label class="form-check-label">
                                    Menghapus Category Items
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Reservasi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-reservasis">
                                <label class="form-check-label">
                                    Melihat Reservasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-reservasis">
                                <label class="form-check-label">
                                    Menambah Reservasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-reservasis">
                                <label class="form-check-label">
                                    Mengedit Reservasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-reservasis">
                                <label class="form-check-label">
                                    Menghapus Reservasi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Pengguna</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-users">
                                <label class="form-check-label">
                                    Melihat Pengguna
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="tambah-users">
                                <label class="form-check-label">
                                    Menambah Pengguna
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="edit-users">
                                <label class="form-check-label">
                                    Mengedit Pengguna
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="hapus-users">
                                <label class="form-check-label">
                                    Menghapus Pengguna
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Journal Bulanan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-journal-bulanans">
                                <label class="form-check-label">
                                    Melihat Journal Bulanan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="d-block">Fitur Stock Logistik</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="lihat-logistiks">
                                <label class="form-check-label">
                                    Melihat Stock
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">

                </div> --}}
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah Peran Pengguna</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<!-- Specific Page -->
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/js/page/item-create.js') }}"></script>
@endpush

@endsection