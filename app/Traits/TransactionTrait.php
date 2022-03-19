<?php
namespace App\Traits;
use App\Models\Pecahan;
use App\Models\Order;
use App\Models\Makanan;
use App\Models\OrderItem;

trait TransactionTrait {
    private function k1($kr,$pc)
    {
        $kmb = [];
        $quotient = (int)($kr / $pc);
        $remainder = $kr % $pc;
        if($quotient == 1)
        {
            $kmb[] = array($quotient, $remainder);

        }
        return $kmb;
    }
    public function kembali($kredit)
    {
        $kredit = 3000;
        $kembali = Pecahan::all()->toArray();
        foreach ($kembali as $key => $value) {
            $banyakU = ($value[''] * $value->jml);
            $pecahan = $value->satuan;
            $pk = $this->k1($kredit,$pecahan);
            dump($pk);
            
        }
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
    public function cek_harga_rendah()
    {
        return Makanan::orderBy('harga','asc')->first();
    }
}