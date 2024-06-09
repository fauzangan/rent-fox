@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Reset Password</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Manajemen Pengguna</a></div>
        <div class="breadcrumb-item">Reset Password</div>
    </div>
</div>

<div class="section-body">
    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Reset Password | User Name : {{ $user->name }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.users.updatePassword', ['user' => $user->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator" name="password">
                        <div id="pwindicator" class="pwindicator pw-very-weak">
                            <div class="bar"></div>
                            <div class="label">sangat lemah</div>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation">
                        @error('password-confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info btn-lg">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
<script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.js') }}"></script>
<script>
    $(".pwstrength").pwstrength();
</script>
@endpush

@endsection