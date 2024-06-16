<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Barang;

class StockProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::get();
        return view('admin.stockProduk',[
            'barangs' => $barangs
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
            'nama' => 'required|string|max:255',
            'stock' => 'required',
            'harga' => 'required',
            'foto' => 'required',
            'foto.*' => 'image'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('danger', $validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $barang = new Barang();
            if($request->hasfile('foto')){
                $file = $request->foto;
                $uploadFolder = "foto_barang/";
                $image = $file;
                $imageName = time().'-'.$image->getClientOriginalName();
                $image->move(public_path($uploadFolder), $imageName);
                $image_link = $imageName;
                $barang->foto = $image_link;
            }
            $existingCount = Barang::count();
            $nextId = str_pad($existingCount + 1, 4, '0', STR_PAD_LEFT);
            $nextId = 'B'.$nextId;
            $barang->kode = $nextId;
            $barang->nama = $request->nama;
            $barang->harga = $request->harga;
            $barang->stock = $request->stock;
            $barang->stock_ready = $request->stock;
            $barang->save();
            DB::commit();
            
            return redirect()->back()->with('success','Produk berhasil ditambahkan ke keranjang');
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
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('danger', $validator->errors()->first());
        }
        $check = Barang::where('id',$request->barang_id)->first();
        if($check){
            DB::beginTransaction();
            try {
                $barang = $check;
                if($request->hasfile('foto')){
                    $file = $request->foto;
                    $uploadFolder = "foto_barang/";
                    $image = $file;
                    $imageName = time().'-'.$image->getClientOriginalName();
                    $image->move(public_path($uploadFolder), $imageName);
                    $image_link = $imageName;
                    $barang->foto = $image_link;
                }
                $barang->nama = $request->nama;
                $old_stock = $barang->stock;
                if($barang->stock_booking <= $request->stock){
                    $barang->stock = $request->stock;
                    $barang->harga = $request->harga;
                    $barang->stock_ready = $request->stock - $barang->stock_booking;
                    $barang->save();
                    DB::commit();
                    return redirect()->back()->with('success','Produk berhasil diedit stock');
                }else{
                    DB::rollback();
                    return redirect()->back()->with('danger', 'Stock tidak boleh kurang dari stock booking.');
                }
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
        $barang = Barang::where('id',$id)->first();
        if($barang){
            if($barang->stok_booking < 1){
                Barang::destroy($id);
                return redirect()->back()->with('success','Produk berhasil dihapus');
            }else{
                return redirect()->back()->with('danger', 'Tidak bisa menghapus product karena sedang dibooking');
            }
        }else{
            return redirect()->back()->with('danger', 'Data Product tidak ditemukan');
        }
    }
}
