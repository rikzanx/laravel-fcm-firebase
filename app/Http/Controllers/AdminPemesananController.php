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
use App\Models\Notification;
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
            $user = Auth::user();
            $pemesanan = Pemesanan::findOrfail($id);
            $pemesanan->status = "konfirmasi";
            $pemesanan->save();
            $notifTitle= "LandsCamping, Pesanan sudah dikonfirmasi";
            $notifBody = "Pesanan sudah dikonfirmasi oleh Admin, Silahkan ambil barangnya.";
            $this->sendNotif($pemesanan->user_id,$notifTitle,$notifBody);
            Notification::create([
                'user_id_from' => $user->id,
                'user_id_to' => $pemesanan->user_id,
                'text' => $notifTitle.' '.$notifBody
            ]);
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
            $user = Auth::user();
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
            Notification::create([
                'user_id_from' => $user->id,
                'user_id_to' => $pemesanan->user_id,
                'text' => $notifTitle.' '.$notifBody
            ]);
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