<div id="form-container">
    <div class="form-group form-item">
        <div class="row">
            <div class="col pr-1">
                <label>Kode Item</label>
                <select class="form-control select-item" name="items[]">
                    <option selected disabled>Pilih Item</option>
                    @foreach($items as $item)
                    <option value="{{ $item->item_id }}" data-harga_sewa="{{ $item->harga_sewa }}" data-satuan_waktu="{{ $item->satuan_waktu }}" data-satuan_item="{{ $item->satuan_item }}">{{ $item->item_id }} | {{ $item->nama_item }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col col-sm-2 pr-1">
                <label>Harga Sewa</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Rp
                        </div>
                    </div>
                    <input type="text" class="form-control harga-sewa" value="" readonly>
                </div>
            </div>
            <div class="col-1 pr-1">
                <label>Kuantitas</label>
                <input type="number" class="form-control jumlah-item" min=1 value=1 name="jumlah_items[]" required>
            </div>
            <div class="col-1 pr-1">
                <label>Satuan</label>
                <input type="text" class="form-control satuan-item" value="" readonly>
            </div>
            <div class="col col-sm-2 pr-1">
                <label>Satuan Waktu</label>
                <input type="text" class="form-control satuan-waktu" value="" readonly>
            </div>
            <div class="col col-sm-1 pr-1">
                <label>Waktu</label>
                <input type="text" class="form-control waktu" name="waktus[]" value="1" required>
            </div>
            <div class="col">
                <label>Jumlah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Rp
                        </div>
                    </div>
                    <input type="text" class="form-control jumlah" name="jumlah_hargas[]" readonly>
                </div>
            </div>
            <button type="button" class="btn btn-danger delete-form-btn" style="margin-top: 30px;"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="button" id="add-form-item"><i class="fas fa-plus"></i></button>
