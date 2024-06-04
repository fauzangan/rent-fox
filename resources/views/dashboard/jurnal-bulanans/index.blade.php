@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>Journal Bulanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.main-dashboard.index') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Journal Bulanan</div>
    </div>
</div>

<div class="section-body d-flex justify-content-center align-items-center">
    <div class="card" style="width: 30rem;">
        <div class="card-header justify-content-center">
            <h4>Journal Bulanan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.jurnal-bulanans.filter') }}" method="POST" id="filterForm">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Periode Bulan Tahun (Bhs. Indonesia)</label>
                            <input type="text" class="form-control @error('bulan_tahun') is-invalid @enderror"
                                id="bulan_tahun" name="bulan_tahun">
                            @error('bulan_tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Rentang Tanggal</label>
                            <input type="text" class="form-control @error('date_range') is-invalid @enderror"
                                id="date_range" name="date_range">
                            @error('date_range')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center p-1">
                    <button type="submit" class="btn btn-primary">View Journal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

{{-- Spesific JS File --}}
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script>
    $(document).ready(function() {

        const validMonths = [
            'januari', 'februari', 'maret', 'april', 'mei', 'juni',
            'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
        ];

        function validateBulanTahun(bulanTahun) {
            const parts = bulanTahun.split(' ');
            if (parts.length !== 2 || !validMonths.includes(parts[0].toLowerCase()) || isNaN(parts[1])) {
                return 'Format bulan dan tahun tidak valid. Contoh: "Mei 2024".';
            }
            return null;
        }

        function showErrorBulan(message) {
            iziToast.error({
                title: 'Input Salah',
                message: message,
                position: 'topRight'
            });
        }

        /* Pengaturan Tanggal Order dan Tanggal Kirim Input */
        $("#date_range").daterangepicker({
            locale: { format: "DD/MM/YYYY" },
            autoUpdateInput: false,
        });
        $("#date_range").attr("placeholder", "");

        $("#date_range").on("apply.daterangepicker", function(ev, picker) {
            $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
            disableOthers(this);
        });

        $("#date_range").on("cancel.daterangepicker", function(ev, picker) {
            $(this).val("");
            checkFields();
        });

        $("#filterForm").on("submit", function(e) {
            // Validasi date range
            let date = $("#date_range").val();
            let bulanTahun = $("#bulan_tahun").val();
            let datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;
            if (date) {
                if (!datePattern.test(date)) {
                    e.preventDefault();
                    iziToast.error({
                        title: 'Tanggal tidak valid',
                        message: 'Harap masukkan tanggal yang benar!',
                        position: 'topRight'
                    });
                } else {
                    let dates = date.split(" - ");
                    let startDate = moment(dates[0], "DD/MM/YYYY", true);
                    let endDate = moment(dates[1], "DD/MM/YYYY", true);

                    if (!startDate.isValid() || !endDate.isValid()) {
                        e.preventDefault();
                        iziToast.error({
                            title: 'Tanggal tidak valid',
                            message: 'Harap masukkan tanggal yang benar!',
                            position: 'topRight'
                        });
                    }
                }
            }
            
            // Validasi bulan_tahun
            if (bulanTahun) {
                let errorMessage = validateBulanTahun(bulanTahun);
                if (errorMessage) {
                    e.preventDefault();
                    showErrorBulan(errorMessage);
                }
            }
        });

        // Enabled and disabled form
        function disableOthers(currentField) {
            $('#bulan_tahun, #date_range').not(currentField).prop('disabled', true);
        }

        function enableAllFields() {
            $('#bulan_tahun, #date_range').prop('disabled', false);
        }

        function checkFields() {
            if ($('#bulan_tahun').val() && !$('#date_range').val()) {
                disableOthers('#bulan_tahun');
            } else if (!$('#bulan_tahun').val() && $('#date_range').val()) {
                disableOthers('#date_range');
            } else {
                enableAllFields();
            }
        }

        $('#bulan_tahun, #date_range').on('input', function() {
            if ($(this).val()) {
                disableOthers(this);
            } else {
                checkFields();
            }
        });

        $('#bulan_tahun, #date_range').on('blur', function() {
            setTimeout(function() {
                // Only enable all fields if all inputs are empty
                if (!$('#bulan_tahun').val() && !$('#date_range').val()) {
                    enableAllFields();
                }
            }, 100); // Delay to allow focus event on another field
        });

        checkFields(); // Initial check when the page loads

    });
</script>
@endpush
@endsection