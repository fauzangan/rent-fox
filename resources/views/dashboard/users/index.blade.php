@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Manajemen Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manajemen Pengguna</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-between my-3">
        <div class="col">
            <div class="section-title my-0">
                Data Pengguna
            </div>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pengguna</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Filter Data</h4>
            <button class="btn btn-primary" type="button" id="filterButton"><i class="fa fa-filter" id="filterIcon"></i></button>
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
                    <div class="col">
                        <div class="form-group">
                            <label>Peran Pengguna</label>
                            <select class="form-control" id="roles_name" name="roles_name">
                                <option selected></option>
                                @foreach($roles as $roles)
                                <option value="{{ $roles->name }}" {{ request('roles_name') == $roles->name ? 'selected' : '' }}>{{ $roles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right py-0 pr-0">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Data Pengguna</h4>
        </div>
        <div class="card-body">
            @if($users->count() == 0)
            <h4 class="text-center">Tidak ada Data</h4>
            @else
            <div class="table-responsive text-center">
                <table class="table table-hover table-bordered table-md">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Peran Pengguna</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="sticky-aksi-head text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            @if($user->roles->count() != 0)
                                @if($user->roles->pluck('name')->contains('Super Admin'))
                                    <td><span class="badge badge-primary" style="color: white">{{ $user->roles->pluck('name')->first() }}</span></td>
                                @else
                                    <td><span class="badge badge-success" style="color: black">{{ $user->roles->pluck('name')->first() }}</span></td>
                                @endif
                            @else
                                <td><span class="badge badge-danger">Tidak ada peran</span></td>
                            @endif
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="sticky-aksi-col">
                                <a href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}" class="btn btn-warning">Edit Data</a>
                                <a href="{{ route('dashboard.users.editPassword', ['user' => $user->id]) }}" class="btn btn-info">Reset Password</a>
                                {{-- <a href="#" class="btn btn-danger" data-confirm-delete="true">Delete</a> --}}
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
                {{-- {{ $users->links() }} --}}
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

        $('button[type="reset"]').on('click', function(event) {
            event.preventDefault(); // Mencegah form mereset secara default
            window.location.href = "{{ route('dashboard.users.index') }}"; // Redirect ke halaman index
        });

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