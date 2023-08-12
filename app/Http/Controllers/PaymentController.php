<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public static function confirmPaymentStatus($tx_ref)
    {
        $SEC_KEY = $_ENV['FLW_SECRET_KEY'];
        $order = Order::where('tx_ref', $tx_ref)->first();

        $query = array(
            "SECKEY" =>  $SEC_KEY,
            "txref" => $tx_ref
        );

        $data_string = json_encode($query);

        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($response);

        $expectedAmount = Str::lower($order->amount);
        $payedAmount = Str::lower($res->data->amount);

        if (($res->data->status === "successful") && ($expectedAmount === $payedAmount) && ($res->data->currency === "NGN")) {
            PaymentController::updatePaymentStatus($tx_ref);
        }
    }

    public static function updatePaymentStatus($tx_ref)
    {
        
        $order = Order::where('tx_ref', $tx_ref)->first();
        if ($order->payment_status == 1) {
            $order->payment_status = 2;
            $order->save();
        }
    }
}
