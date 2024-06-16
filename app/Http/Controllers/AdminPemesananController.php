<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pemesanan;
use App\Models\PemesananItem;
use App\Models\Keranjang;
use App\Models\Barang;

class AdminPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::with('items.barang')->get();
        // dd($pemesanans);
        return view('admin.pemesanan',[
            'pemesanans' => $pemesanans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'jumlah_hari' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('danger', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $keranjangs = Keranjang::with('barang')->where('user_id',$user->id)->get(); 
            $existingCount = Pemesanan::count();
            $nextId = str_pad($existingCount + 1, 5, '0', STR_PAD_LEFT);
            $nextId = 'INV'.$nextId;

            $pemesanan = new Pemesanan();
            $pemesanan->user_id = $user->id;
            $pemesanan->no_pemesanan = $nextId;
            $pemesanan->jumlah_hari = $request->jumlah_hari;
            $pemesanan->catatan = $request->catatan;
            $pemesanan->save();
            $total_harga = 0;
            foreach($keranjangs as $keranjang)
            {
                $barang = Barang::where('id',$keranjang->barang->id)->first();
                if($barang->stock_ready < $keranjang->jumlah){
                    DB::rollback();
                    return redirect()->back()->with('danger', 'Ada item yang melebihi stock. Silahkan cek lagi');
                }
                $barang->stock_ready = $barang->stock_ready - $keranjang->jumlah;
                $barang->stock_booking = $barang->stock_booking + $keranjang->jumlah;
                $barang->save();

                $sub_total = ($keranjang->barang->harga * $keranjang->jumlah) * $request->jumlah_hari;
                $total_harga += $sub_total;
                $item = new PemesananItem();
                $item->pemesanan_id = $pemesanan->id;
                $item->barang_id = $keranjang->barang->id;
                $item->harga = $keranjang->barang->harga;
                $item->jumlah = $keranjang->jumlah;
                $item->jumlah_hari = $request->jumlah_hari;
                $item->sub_total = $sub_total;
                $item->save();
            }

            $pemesanan->total_harga = $total_harga;
            $pemesanan->save();
            Keranjang::where('user_id',$user->id)->delete();

            DB::commit();
            return redirect()->back()->with('success','Pemesanan Berhasil Dibuat');
        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambahkan Product".$e->message;
            return redirect()->back()->with('danger', $ea);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
