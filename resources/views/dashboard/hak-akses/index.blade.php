@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Hak Akses</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Pengguna</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Peran Pengguna
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.hak-akses.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Peran Pengguna</a>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-plus" id="filterIcon"></i></button>
        </div>
        <div class="card-body" id="filterForm" style="display: none">
            <form action="#" method="GET">
                <div class="row align-items-center">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" id="name" name="name" value="{{ request('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" value="{{ request('username') }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right py-0 pr-0">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
            <h4>Hak Akses Berdasarkan Peran</h4>
        </div>
        <div class="card-body">
            @if($roles->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Nama Peran <span data-toggle="tooltip" title="Kode Barang"><i class="fas fa-question-circle"></i></span></th>
                            <th>Hak akses</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if($role->permissions->count() > 0)
                                    @foreach($role->permissions->pluck('name') as $name)
                                        <span class="badge badge-dark my-1">{{ $name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge badge-danger my-1">Tidak ada hak akses</span>
                                @endif
                            </td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.hak-akses.edit', ['role' => $role->id]) }}" class="btn btn-warning btn-block">Edit</a>
                                <a href="#" class="btn btn-danger btn-block" data-confirm-delete="true">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{-- {{ $roles->links() }} --}}
            </nav>
        </div>
    </div>
</div>

@push('styles')
<style>
    .sticky-aksi-head {
        position: sticky;
        right: 0;
        z-index: 999;
        background-color: #f5f5f5 !important;
        /* Warna latar belakang */
    }

    .sticky-aksi-col {
        position: sticky;
        right: 0;
        z-index: 999;
        background-color: #ffffff !important;
        /* Warna latar belakang */
    }

    .badge-currency {
        border-radius: 5px !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script>
    $(document).ready(function() {
        // Function to get query string value
        function getQueryStringParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Check if any of the specified query strings exist
        const fields = ['item_id', 'nama_item', 'category_item_id'];
        let formShouldShow = false;
        
        fields.forEach(field => {
            if (getQueryStringParameter(field)) {
                formShouldShow = true;
            }
        });

        if (formShouldShow) {
            $('#filterForm').show();
            $('#filterIcon').toggleClass('fa-filter fa-minus');
        }

        $('#filterButton').click(function() {
            $('#filterForm').toggle('slow', 'swing');
            $('#filterIcon').toggleClass('fa-filter fa-minus');
        });
    });
</script>
@endpush
@endsection