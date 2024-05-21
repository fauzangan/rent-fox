<div id="form-container">
    @foreach($order->orderItems as $item)
    <div class="form-group form-item">
        <div class="row">
            <div class="col pr-1">
                <label>Kode Item</label>
                <select class="form-control select-item" name="items[]">
                    <option selected disabled>Pilih Item</option>
                    @foreach($items as $availableItem)
                    <option value="{{ $availableItem->item_id }}" 
                            data-harga_sewa="{{ $availableItem->harga_sewa }}" 
                            data-satuan_waktu="{{ $availableItem->satuan_waktu }}" 
                            data-satuan_item="{{ $availableItem->satuan_item }}"
                            @if($availableItem->item_id == $item->item_id) selected @endif>
                            {{ $availableItem->item_id }} | {{ $availableItem->nama_item }}
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
                    <input type="text" class="form-control harga-sewa" value="{{ $item->harga_sewa }}" readonly>
                </div>
            </div>
            <div class="col-1 pr-1">
                <label>Kuantitas</label>
                <input type="number" class="form-control jumlah-item" min=0 value="{{ $item->jumlah_item }}" name="jumlah_items[]">
            </div>
            <div class="col-1 pr-1">
                <label>Satuan</label>
                <input type="text" class="form-control satuan-item" value="{{ $item->satuan_item }}" readonly>
            </div>
            <div class="col col-sm-2 pr-1">
                <label>Satuan Waktu</label>
                <input type="text" class="form-control satuan-waktu" value="{{ $item->satuan_waktu }}" readonly>
            </div>
            <div class="col col-sm-1 pr-1">
                <label>Waktu</label>
                <input type="text" class="form-control waktu" name="waktus[]" value="{{ $item->waktu }}">
            </div>
            <div class="col">
                <label>Jumlah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Rp
                        </div>
                    </div>
                    <input type="text" class="form-control jumlah" name="jumlah_hargas[]" value="{{ $item->jumlah }}" readonly>
                </div>
            </div>
            <button type="button" class="btn btn-danger delete-form-btn" style="margin-top: 30px;"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    @endforeach
</div>
<button class="btn btn-primary" type="button" id="add-form-item"><i class="fas fa-plus"></i></button>