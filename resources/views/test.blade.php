@extends('dashboard.layouts.main')
@section('content')
<div class="section-header">
    <h1>TESTING PAGE</h1>
</div>

<div class="section-body">
    <form id="dynamic-form">
        <div id="form-container">
            <div class="form-group">
                <div class="form-item">
                    <input type="text" class="form-control" name="item[]" placeholder="Item 1">
                    <button type="button" class="btn btn-danger delete-btn">Hapus</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="add-form-btn">Tambah Form</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
$(document).ready(function() {
  var formCounter = 1;

  // Tambah form item baru
  $("#add-form-btn").click(function() {
    formCounter++;
    var newFormItem = '<div class="form-group"><input type="text" class="form-control" name="item[]" placeholder="Item ' + formCounter + '" id="item' + formCounter + '"><button type="button" class="delete-btn">Hapus</button></div>';
    $("#form-container").append(newFormItem);
    toggleDeleteButton();
  });

  // Hapus form item
  $("#form-container").on("click", ".delete-btn", function() {
    $(this).parent(".form-group").remove();
    formCounter--;
    toggleDeleteButton();
  });

  // Fungsi untuk menampilkan atau menyembunyikan tombol hapus
  function toggleDeleteButton() {
    if (formCounter > 1) {
      $(".delete-btn").show();
    } else {
      $(".delete-btn").hide();
    }
  }

  // Panggil fungsi toggleDeleteButton saat halaman dimuat
  toggleDeleteButton();
});
</script>
@endpush
@endsection