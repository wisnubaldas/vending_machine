<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    public function masukan_uang(Request $request)
    {
        $uang = self::cek_uang($request->uang);
        if (!$uang) {
            return response()
            ->json(['message' => 'uang yg anda masukan salah, coba lagi'],500);
        }
        $order = self::cek_order_baru();
        if($order)
        {
            $kredit = self::tambah_kredit($order->id,$request->uang);
            $makanan = self::cek_harga_barang($kredit);

        }else{
            $order->id = self::buat_order($request->uang);
            $makanan = self::cek_harga_barang($request->uang);

        }
        if(count($makanan) > 0)
        {
            return response()
                    ->json([
                        'message' => 'uang anda cukup untuk membeli '.implode(', ',$makanan->toArray()),
                        'data'=>$makanan,
                        'order_id'=>$order->id,
                    ],200);
        }else{
            return response()
                    ->json(['message' => 'uang anda belom cukup untuk membeli cemilan'],500);
        }
        
    }
    public function pilih_makanan(Request $request)
    {
        $sisa_kredit = self::item_makanan($request->makanan,$request->order_id);
        if($sisa_kredit < 0 || $sisa_kredit == 0)
        {
            return response()
                    ->json(['message' => 'Terimakasih telah belanja di Vending machine kami'],200);
        }else{
            $x = [];
            foreach (self::kembali($sisa_kredit) as $v) {
                $x[] = 'uang pecahan '.$v['pecahan'].' sebanyak '.$v['jml_pecahan'].' lembar';
            }
            return response()
                    ->json([
                        'message' => 'Terimakasih telah belanja di Vending machine kami',
                        'kembalian'=>$x
                    ],200);
            
        }
    }
}
