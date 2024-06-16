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
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::with(['items.barang','user'])->get();
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

    public function approve($id)
    {
        DB::beginTransaction();
        try{
            $pemesanan = Pemesanan::findOrfail($id);
            $pemesanan->status = "konfirmasi";
            $pemesanan->save();
            $notifTitle= "LandsCamping, Pesanan sudah dikonfirmasi";
            $notifBody = "Pesanan sudah dikonfirmasi oleh Admin, Silahkan ambil barangnya.";
            $this->sendNotif($pemesanan->user_id,$notifTitle,$notifBody);
            DB::commit();
            return redirect()->back()->with('success','Pemesanan Berhasil DiApprove');
        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat mengapprove Pesanan ".$e->message;
            return redirect()->back()->with('danger', $ea);
        }

    }

    public function reject($id)
    {
        DB::beginTransaction();
        try{
            $pemesanan = Pemesanan::with('items')->where('id',$id)->firstOrFail();
            if($pemesanan->status_pengembalian == 0)
            {
                foreach($pemesanan->items as $item)
                {
                    $barang = Barang::where('id',$item->id)->firstOrFail();
                    $barang->stock_ready = $barang->stock_ready + $item->jumlah;
                    $barang->stock_booking = $barang->stock_booking - $item->jumlah;
                    $barang->save();
                }
            }
            
            $pemesanan->status = "ditolak";
            $pemesanan->status_pengembalian = 1;
            $pemesanan->save();

            $notifTitle= "LandsCamping, Pesanan Ditolak";
            $notifBody = "Pesanan sudah ditolak oleh Admin, Silahkan hubungin admin.";
            $this->sendNotif($pemesanan->user_id,$notifTitle,$notifBody);
            
            DB::commit();
            return redirect()->back()->with('success','Pemesanan Berhasil DiReject');

        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat mereject Pesanan ".$e->message;
            return redirect()->back()->with('danger', $ea);
        }
        
    }
    
    public function return($id)
    {
        DB::beginTransaction();
        try{
            $pemesanan = Pemesanan::with('items')->where('id',$id)->firstOrFail();
            if($pemesanan->status_pengembalian == 0)
            {
                foreach($pemesanan->items as $item)
                {
                    $barang = Barang::where('id',$item->id)->firstOrFail();
                    $barang->stock_ready = $barang->stock_ready + $item->jumlah;
                    $barang->stock_booking = $barang->stock_booking - $item->jumlah;
                    $barang->save();
                }
            }

            $pemesanan->status_pengembalian = 1;
            $pemesanan->save();

            DB::commit();
            return redirect()->back()->with('success','Pemesanan Berhasil DiRetur');

        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat meretur Pesanan ".$e->message;
            return redirect()->back()->with('danger', $ea);
        }
    }

    private function sendNotif($user_id,$title,$body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::where('id',$user_id)->whereNotNull('fcm_token')->pluck('fcm_token')->all();
            
        $serverKey = 'AAAARSFMIAE:APA91bG5s_2_Kee0Yt1ARV0uhuyg4w5VFnPUVPOm0pRJ8vV8GaRtbVPxE8eb_Hhg2JqrZ-FsI1fyImKU-HVScrQe_i36Q2E04meuyg1k5t6Ur5moz-avDnFYVoahYWaR90KaYvtDSF-4'; // ADD SERVER KEY HERE PROVIDED BY FCM
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $title,
                "body" => $body
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            Log::error('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
    }
}