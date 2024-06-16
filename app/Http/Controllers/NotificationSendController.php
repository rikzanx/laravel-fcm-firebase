<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class NotificationSendController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function updateDeviceToken(Request $request)
    {
        // /dd('a');
        Auth::user()->fcm_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
            
        $serverKey = 'AAAARSFMIAE:APA91bG5s_2_Kee0Yt1ARV0uhuyg4w5VFnPUVPOm0pRJ8vV8GaRtbVPxE8eb_Hhg2JqrZ-FsI1fyImKU-HVScrQe_i36Q2E04meuyg1k5t6Ur5moz-avDnFYVoahYWaR90KaYvtDSF-4'; // ADD SERVER KEY HERE PROVIDED BY FCM
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
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
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
    }
}