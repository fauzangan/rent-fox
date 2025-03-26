@extends('dashboard.layouts.main')
@section('content')


<div class="section-header mb-4">
    <h1>Periode Final</h1>
</div>

<div class="section-body">
    <div class="card card-danger">
        <div class="card-body ">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="tagihan-scaffolding-tab" data-toggle="tab"
                        href="#tagihan-scaffolding" role="tab" aria-controls="tagihan-scaffolding"
                        aria-selected="true">Tagihan Scaffolding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pengiriman-pengembalian-tab" data-toggle="tab" href="#pengiriman-pengembalian" role="tab"
                        aria-controls="pengiriman-pengembalian" aria-selected="false">Pengiriman/Pengembalian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="tagihan-scaffolding" role="tabpanel"
                    aria-labelledby="tagihan-scaffolding-tab">
                    <div class="row mt-4">
                        <!-- Form Input Info -->
                        <div class="col">
                            <div class="form-group">
                                <label for="kodeOrder">Kode Order</label>
                                <input class="form-control" type="text" id="kodeOrder" value="7" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="namaCustomer">Nama Customer</label>
                                <input class="form-control" type="text" id="namaCustomer" value="John Doe" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="namaPerusahaan">Nama Perusahaan</label>
                                <input class="form-control" type="text" id="namaPerusahaan" value="PT Scaffolding"
                                    readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="proyek">Proyek</label>
                                <input class="form-control" type="text" id="proyek" value="Gedung A" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="alamatKirim">Alamat Kirim</label>
                                <input class="form-control" type="text" id="alamatKirim" value="Jl. Proyek No. 10"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-md small-font-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No. Urut</th>
                                            <th>Kode Item</th>
                                            <th>Nama Item</th>
                                            <th>Jumlah Baik</th>
                                            <th>Jumlah Kurang</th>
                                            <th>Jumlah Berat</th>
                                            <th>Harga Sewa/Bulan (Rp)</th>
                                            <th>Harga Sewa/Hari (Rp)</th>
                                            <th>Discount (%)</th>
                                            <th>Jumlah Tagihan (Rp)</th>
                                            <th>Data Log</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Contoh Data -->
                                        <tr>
                                            <td>1</td>
                                            <td>CF006</td>
                                            <td>Jack Base 40cm</td>
                                            <td>207</td>
                                            <td>-197</td>
                                            <td>10</td>
                                            <td>2,150</td>
                                            <td>71.67</td>
                                            <td>10</td>
                                            <td>75,600</td>
                                            <td>OK</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>CF011</td>
                                            <td>Main Frame 170</td>
                                            <td>120</td>
                                            <td>-13</td>
                                            <td>7</td>
                                            <td>4,350</td>
                                            <td>145.00</td>
                                            <td>10</td>
                                            <td>108,900</td>
                                            <td>OK</td>
                                        </tr>
                                        <!-- Tambahkan data lainnya sesuai kebutuhan -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row mt-4">
                        <div class="col text-right">
                            <button class="btn btn-primary">Print</button>
                            <button class="btn btn-success">Save</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pengiriman-pengembalian" role="tabpanel" aria-labelledby="pengiriman-pengembalian-tab">
                    Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis
                    quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus.
                    Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur,
                    eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget
                    scelerisque tellus pharetra a.
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in
                    lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus,
                    nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut
                    ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum
                    augue ut luctus.
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
<style>
    .small-font-table {
        font-size: 12px;
        /* Sesuaikan ukuran font */
    }
</style>
@endpush

@push('scripts')
{{-- JS Libraries --}}
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- Specific JS File -->
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
@endpush
@endsection