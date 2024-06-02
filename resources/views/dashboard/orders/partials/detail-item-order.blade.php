<div class="table-responsive text-nowrap text-center">
    <table class="table table-bordered table-hover table-md">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Harga Sewa</th>
                <th>Kuantitas Sewa</th>
                <th>Satuan</th>
                <th>Jumlah Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $order_item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order_item->item_id }}</td>
                <td>{{ $order_item->nama_item }}</td>
                <td>Rp {{ number_format($order_item->harga_sewa,0,",",".").',-' }}</td>
                <td>{{ $order_item->jumlah_item }}</td>
                <td>{{ $order_item->satuan }}</td>
                <td>Rp {{ number_format($order_item->jumlah_harga,0,",",".").',-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color:gainsboro">
                <td colspan="6"><strong>Subtotal Harga</strong></td>
                <td><strong>Rp {{ number_format($order->subtotal,0,",",".").',-' }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>