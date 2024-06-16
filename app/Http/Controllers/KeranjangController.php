<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Models\Notification;


class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::with('sender')->where('user_id_to',$user->id)->get();
        $barangs = Barang::get();
        $keranjangs = Keranjang::with('barang')->where('user_id',$user->id)->get();
        return view('user.keranjang',[
            'barangs' => $barangs,
            'keranjangs' => $keranjangs,
            'notifications' => $notifications
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
        $validator = Validator::make($request->all(), [
            'barang' => 'required',
            'jumlah' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('danger', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $barang = Barang::where('id',$request->barang)->first();
            if($barang->stock_ready < $request->jumlah){
                return redirect()->back()->with('danger','Jumlah yang anda input melebihi ready stock.');
            }
            $check = Keranjang::where('user_id',$user->id)->where('barang_id',$request->barang)->first();
            if($check){
                $keranjang = $check;
                if(($keranjang->jumlah + $request->jumlah) > $barang->stock_ready ){
                    return redirect()->back()->with('danger','Jumlah yang anda input melebihi ready stock.');
                }
                $keranjang->jumlah = $keranjang->jumlah + $request->jumlah;
                $keranjang->save();
            }else{
                $keranjang = new Keranjang();
                $keranjang->user_id = $user->id;
                $keranjang->barang_id = $request->barang;
                $keranjang->jumlah = $request->jumlah;
                $keranjang->save();
            }
            DB::commit();
            return redirect()->back()->with('success','Produk berhasil ditambahkan ke keranjang');
        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambahkan keranjang".$e->message;
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
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('danger', $validator->errors()->first());
        }
        $check = Keranjang::with('barang')->where('id',$id)->first();
        if($check){
            DB::beginTransaction();
            try {
                $keranjang = $check;
                if($keranjang->barang->stock_ready < $request->jumlah){
                    return redirect()->back()->with('danger','Jumlah yang anda input melebihi ready stock.');
                }
                $keranjang->jumlah = $request->jumlah;
                $keranjang->save();
                DB::commit();
                return redirect()->back()->with('success','Data Keranjang berhasil diupdate');
            }catch (\Exception $e) {
                DB::rollback();
                $ea = "Terjadi Kesalahan saat menambahkan Product".$e->message;
                return redirect()->back()->with('danger', $ea);
            }
        }else{
            return redirect()->back()->with('danger', 'Data Product tidak ditemukan');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keranjang = Keranjang::where('id',$id)->first();
        if($keranjang){
            Keranjang::destroy($id);
            return redirect()->back()->with('success','Data Keranjang berhasil dihapus');
        }else{
            return redirect()->back()->with('danger', 'Data Keranjang tidak ditemukan');
        }
    }
}
