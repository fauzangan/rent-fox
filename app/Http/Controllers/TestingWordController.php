<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class TestingWordController extends Controller
{
    public function createInvoiceFromTemplate($orderId){
        $order = Order::find($orderId);

        $templatePath = storage_path('app/public/word-template/invoice-test.docx');

        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('tanggal_order', $order->tanggal_order);
        $templateProcessor->setValue('kirim_kepada', $order->kirim_kepada);
        $templateProcessor->setValue('alamat_kirim', $order->alamat_kirim);

        // Mengganti placeholder tabel dengan data dari order items
        $values = [];
        foreach ($order->orderItems as $item) {
            $values[] = [
                'table_item' => $item->nama_item,
                'table_qty' => $item->harga_sewa,
                'table_price' => number_format($item->jumlah_harga, 2),
            ];
        }

        // Gantikan seluruh placeholder tabel
        $templateProcessor->cloneRowAndSetValues('table_item', $values);

        $fileName = 'Invoice_'.$order->order_id.'.docx';
        $filePath = storage_path('app/public/'. $fileName);

        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
