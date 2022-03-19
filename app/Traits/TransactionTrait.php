<?php
namespace App\Traits;
use App\Models\Pecahan;
use App\Models\Order;
use App\Models\Makanan;
use App\Models\OrderItem;

trait TransactionTrait {
    private function cari_pecahan($kredit,$pass = [])
    {
        $kembalian = [];
        foreach (Pecahan::all() as $key => $value) {
            if($value->jml < 1)
            {
                unset($value);
            }else{
                $pk = $this->k1($kredit,$value->satuan);
                $pk['pecahan'] = $value->satuan;
                $pk['jml_uang_pecahan'] = $value->jml;
                
                if($pk['sisa'] != $kredit)
                {
                    array_push($kembalian,$pk);
                }
            }
        }
        $kembalian = collect($kembalian)->sortBy(['jml_pecahan','sisa'])->first();
       return $pass[] = [$kembalian];
    }
    private function k1($kr,$pc)
    {
        $quotient = (int)($kr / $pc);
        $remainder = $kr % $pc;
        return array('jml_pecahan'=>$quotient, 'sisa'=>$remainder);
    }
    public function kembali($kredit)
    {
        // $kredit = 8000;
        $kembalian = $this->cari_pecahan($kredit);
        foreach ($kembalian as $key => $value) {
            if($value['sisa'] != 0)
            {
                $sisa = $this->cari_pecahan($value['sisa'],$kembalian);
                $kembalian[] = $sisa[0];
            }
        }
        return $kembalian;
    }
    public function item_makanan($makanan,$order_id)
    {
        $makanan = Makanan::where('nama',$makanan)->first();
        $item = new OrderItem;
        $item->order_id = $order_id;
        $item->makanan_id = $makanan->id;
        $item->jml = 1;
        $item->save();
        
        $order = Order::find($order_id);
        $order->kredit = (int)$order->kredit - (int)$makanan->harga;
        $order->save();
        return $order->kredit;
    }
    public function tambah_kredit($id_order,$uang)
    {
        $order = Order::find($id_order);
        $order->kredit = (int)$order->kredit + (int)$uang;
        $order->save();
        return $order->kredit;
    }
    public static function buat_order($uang)
    {
        $order = new Order;
        $latestOrder = Order::orderBy('created_at','DESC')->first();
        if($latestOrder)
        {
            $latestOrder = $latestOrder->id;
        }else{
            $latestOrder = 0;
        }
        $order->order = '#'.str_pad($latestOrder + 1, 8, "0", STR_PAD_LEFT);
        $order->void = 1;
        $order->kredit = $uang;
        $order->save();
        return $order->id;
    }
    public static function cek_order_baru()
    {
        return Order::where('void',1)->first();
    }
    public static function cek_uang($uang)
    {
        return Pecahan::where('satuan',$uang)->where('void',1)->count();
    }
    public static function cek_harga_barang($uang)
    {
        return Makanan::where('harga','<=',(int)$uang)->get()->pluck('nama');
    }
    
}