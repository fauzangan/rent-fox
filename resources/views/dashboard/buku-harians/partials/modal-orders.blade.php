<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Detail Kode Order : <span id="modalOrderId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col pr-0">
                        <div class="form-group">
                            <label for="">Subtotal</label>
                            <input type="text" class="form-control" id="modalTotalHarga" disabled>
                        </div>
                    </div>
                    <div class="col-2 pr-0">
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="text" class="form-control" id="modalDiscount" disabled>
                        </div>
                    </div>
                    <div class="col pr-0">
                        <div class="form-group">
                            <label for="">Biaya Sewa</label>
                            <input type="text" class="form-control" id="modalTotalHargaDisc" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Biaya Transport</label>
                            <input type="text" class="form-control" id="modalBiayaTransport" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive text-nowrap text-center">
                        <table id="modalOrderItems" class="table table-hover table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>