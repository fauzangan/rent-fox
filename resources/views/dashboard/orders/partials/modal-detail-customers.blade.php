<!-- Modal Customer -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Detail Customer :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col pr-0">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->nama }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Identitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->jenis_identitas }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Identitas Berlaku</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->identitas_berlaku ?? 'Selamanya' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Identitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->nomor_identitas}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->jabatan }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" disabled>{{ $order->customer->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->kota }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->provinsi }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Handphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->handphone }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->perusahaan->badan_hukum ?? '-' }} {{ $order->customer->perusahaan->nama ?? '' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Perusahaan</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" disabled>{{ $order->customer->perusahaan->alamat ?? '-' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->perusahaan->kota ?? '-' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->perusahaan->provinsi ?? '-' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Telephone Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->perusahaan->telp ?? '-' }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fax Perusahaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $order->customer->perusahaan->fax ?? '-' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Customer -->