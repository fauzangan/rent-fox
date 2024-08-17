@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>403: Unauthorize</h1>
</div>

<div class="section-body d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div>
        <div class="row">
            <div class="col">
                <h5 class="text-center">{{ $exception }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 class="text-center">Anda tidak memiliki hak akses ke fitur ini</h5>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
@endpush

@endsection