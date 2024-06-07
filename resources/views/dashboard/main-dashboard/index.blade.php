@extends('dashboard.layouts.main')
@section('content')

<div class="section-body">
    <div class="row">
        <div class="col-lg-6 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Order Statistics -
                        <input name="orderDate" id="orderDate" class="date-picker"/>
                    </div>
                    <div class="card-stats-items owl-carousel" id="orders-carousel">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusOrderAktif"></span></div>
                            <div class="card-stats-item-label">Aktif</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusOrderTutup"></span></div>
                            <div class="card-stats-item-label">Tutup</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusOrderTunda"></span></div>
                            <div class="card-stats-item-label">Tunda/Batal</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusOrderDel"></span></div>
                            <div class="card-stats-item-label">Del</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Orders</h4>
                    </div>
                    <div class="card-body">
                        <span id="totalOrders"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Tagihan Statistics -
                        <input name="tagihanDate" id="tagihanDate" class="date-picker"/>
                    </div>
                    <div class="card-stats-items owl-carousel" id="tagihans-carousel">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansDitagihkan"></span></div>
                            <div class="card-stats-item-label">Ditagihkan</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansDibayarSebagian"></span></div>
                            <div class="card-stats-item-label">Dibayar Sebagian</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansLunas"></span></div>
                            <div class="card-stats-item-label">Lunas</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansLebihBayar"></span></div>
                            <div class="card-stats-item-label">Lebih Bayar</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansBermasalah"></span></div>
                            <div class="card-stats-item-label">Bermasalah</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansLunasTanggungan"></span></div>
                            <div class="card-stats-item-label">Lunas tanggungan</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansTutupTanggungan"></span></div>
                            <div class="card-stats-item-label">Tutup Tanggungan</div>
                        </div>          
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><span id="statusTagihansTutupDel"></span></div>
                            <div class="card-stats-item-label">Del</div>
                        </div>          
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Tagihan</h4>
                    </div>
                    <div class="card-body">
                        <span id="totalTagihans"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Customer</h4>
                   </div>
                    <div class="card-body">
                        {{ $totalCustomer }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Order</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalOrder }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku Harian</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalBukuHarian }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Online Users</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div>                  
      </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-auto col-md-4 pr-1">
                            <h4>Harian Gudang Log</h4>
                        </div>
                        <div class="col-lg-5 col-md-4 pl-1">
                            <input name="logistikHarianDate" id="logistikHarianDate" class="date-picker form-control"/>
                        </div>
                    </div>
                </div>
                <div class="card-body">    
                    <canvas id="logisticsChart" height="158"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                  <h4>Jatuh Tempo Order</h4>
                  <div class="card-header-action">
                    <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div id="scrollTagihan" class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped small">
                      <tbody><tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Due Date</th>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87239</a></td>
                        <td class="font-weight-600">Kusnadi</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 19, 2018</td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-48574</a></td>
                        <td class="font-weight-600">Hasan Basri</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 21, 2018</td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-76824</a></td>
                        <td class="font-weight-600">Muhamad Nuruzzaki</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-84990</a></td>
                        <td class="font-weight-600">Agung Ardiansyah</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87320</a></td>
                        <td class="font-weight-600">Ardian Rahardiansyah</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 28, 2018</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/modules/jquery-ui/jquery-ui.min.css') }}"> --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
<style>
    .ui-datepicker-calendar {
        display: none;
    }

    .card-stats-item-label {
        overflow: visible !important;
    }

    .card-stats-item{
        width: 100% !important;
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

<!-- Spesific JS File -->
<script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/modules/chart-js/chart.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="{{ asset('assets/js/page/index.js') }}"></script>

<!-- JS Libraies -->
{{-- <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        initializeDatepicker();
        setDefaultOrdersDate();
        setDefaultTagihansDate();
        fetchOrders();
        fetchTagihans();

        $('#orderDate').change(function () {
            fetchOrders();
        });

        $('#tagihanDate').change(function () {
            fetchTagihans();
        });

        $("#tagihans-carousel").owlCarousel({
            items: 8,
            margin: 0,
            autoplay: false,
            loop: false,
            center: false,
            responsive: {
                0: {
                items: 2
                },
                768: {
                items: 3
                },
                1200: {
                items: 4
                }
            }
        });

        $("#orders-carousel").owlCarousel({
            items: 4,
            margin: 0,
            autoplay: false,
            loop: false,
            center: false,
            responsive: {
                0: {
                items: 2
                },
                768: {
                items: 3
                },
                1200: {
                items: 4
                }
            }
        });

        $("#scrollTagihan").css({
            height: 328
        }).niceScroll();
        
    });

    function initializeDatepicker() {
        $('#orderDate').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: handleOrdersDatepickerClose
        });

        $('#tagihanDate').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: handleTagihansDatepickerClose
        });
    }

    // Order Fetching Function Group
    function handleOrdersDatepickerClose(dateText, inst) {
        const selectedDate = new Date(inst.selectedYear, inst.selectedMonth, 1);
        $(this).datepicker('setDate', selectedDate);
        fetchOrders();
    }

    function setDefaultOrdersDate() {
        const today = new Date();
        const month = today.toLocaleString('default', { month: 'long' });
        const year = today.getFullYear();
        $('#orderDate').val(`${month} ${year}`);
    }

    function fetchOrders() {
        const date = $('#orderDate').val();

        $.ajax({
            url: "{{ route('dashboard.main-dashboard.getOrdersByDate') }}",
            type: 'GET',
            data: { date: date},
            success: function(response){
                displayOrders(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching orders:', error);
            }
        });
    }

    function displayOrders(response) {
        $('#totalOrders').text(response.totalOrders);
        $('#statusOrderAktif').text(response.statusOrderAktif);
        $('#statusOrderTutup').text(response.statusOrderTutup);
        $('#statusOrderTunda').text(response.statusOrderTunda);
        $('#statusOrderDel').text(response.statusOrderDel);
    }

    // Fetch Tagihans Function Group
    function handleTagihansDatepickerClose(dateText, inst) {
        const selectedDate = new Date(inst.selectedYear, inst.selectedMonth, 1);
        $(this).datepicker('setDate', selectedDate);
        fetchTagihans();
    }

    function setDefaultTagihansDate() {
        const today = new Date();
        const month = today.toLocaleString('default', { month: 'long' });
        const year = today.getFullYear();
        $('#tagihanDate').val(`${month} ${year}`);
    }
 
    function fetchTagihans() {
        const date = $('#tagihanDate').val();

        $.ajax({
            url: "{{ route('dashboard.main-dashboard.getTagihansByDate') }}",
            type: 'GET',
            data: { date: date},
            success: function(response){
                displayTagihans(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching tagihans:', error);
            }
        });
    }

    function displayTagihans(response) {
        $('#totalTagihans').text(response.totalTagihans);
        $('#statusTagihansDitagihkan').text(response.statusTagihansDitagihkan);
        $('#statusTagihansDibayarSebagian').text(response.statusTagihansDibayarSebagian);
        $('#statusTagihansLunas').text(response.statusTagihansLunas);
        $('#statusTagihansLebihBayar').text(response.statusTagihansLebihBayar);
        $('#statusTagihansBermasalah').text(response.statusTagihansBermasalah);
        $('#statusTagihansLunasTanggungan').text(response.statusTagihansLunasTanggungan);
        $('#statusTagihansTutupTanggungan').text(response.statusTagihansTutupTanggungan);
        $('#statusTagihansTutupDel').text(response.statusTagihansTutupDel);
    }
</script>
<script>
    $(document).ready(function() {
        initializeLogistikDatepicker();
        setDefaultLogistikHariansDate();

        $('#logistikHarianDate').on('change', handleLogistiksHariansDateChange);
    });

    function initializeLogistikDatepicker() {
        $('#logistikHarianDate').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: handleLogistiksHariansDatepickerClose
        });
    }

    function handleLogistiksHariansDatepickerClose(dateText, inst) {
        const selectedDate = new Date(inst.selectedYear, inst.selectedMonth, 1);
        $(this).datepicker('setDate', selectedDate);
        fetchLogisticsData();
    }

    function handleLogistiksHariansDateChange() {
        fetchLogisticsData();
    }

    function setDefaultLogistikHariansDate() {
        const today = new Date();
        const month = today.toLocaleString('default', { month: 'long' });
        const year = today.getFullYear();
        $('#logistikHarianDate').val(`${month} ${year}`);
        fetchLogisticsData();
    }

    function fetchLogisticsData() {
        const date = $('#logistikHarianDate').val();

        $.ajax({
            url: "{{ route('dashboard.main-dashboard.getLogistikHariansByDate') }}",
            type: 'GET',
            data: { date: date },
            success: function(response) {
                updateLogisticsChart(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function updateLogisticsChart(response) {
        const labels = ['Transaksi Pengiriman', 'Transaksi Pengembalian'];
        const values = [response.logistikHariansPengiriman, response.logistikHariansPengembalian];
        const maxVal = Math.max(...values) + 5; // Add 5 to the maximum value for better visualization

        if (logisticsChart) {
            logisticsChart.destroy();
        }

        logisticsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jumlah Transaksi'],
                datasets: [
                    {
                        label: 'Transaksi Pengiriman',
                        data: [response.logistikHariansPengiriman],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Transaksi Pengembalian',
                        data: [response.logistikHariansPengembalian],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: maxVal
                    }
                }
            }
        });
    }

    const ctx = document.getElementById('logisticsChart').getContext('2d');
    let logisticsChart;
</script>
@endpush
@endsection