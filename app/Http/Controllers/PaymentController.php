<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function process($data)
    {
        $SEC_KEY = $_ENV['FLW_SECRET_KEY'];

        $redirectUrl = route('frontend.payment.confirmation');

        $data_options = [
            'tx_ref' => time(),
            'amount' => $data['amount'],
            'currency' => 'NGN',
            'payment_options' => 'card, banktransfer, ussd',
            'redirect_url' => $redirectUrl,
            'customer' => [
                'email' => $data['customer_email'],
                'phonenumber' => $data['customer_phone'],
                'name' => $data['customer_name']
            ],
            'meta' => [
                'price' => $data['amount']
            ],
            'customizations' => [
                'title' => 'Bill Payment', //Set your title
                'description' => 'Bill Payment For #' . $data['ulid']
            ]
        ];

        $ch = curl_init('https://api.flutterwave.com/v3/payments');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_options);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer {$SEC_KEY}"));

        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response);

        return $response;
    }

    public function confirmation($txRef, $type)
    {

        $order = Order::where('ulid', $txRef)->first();

        if ($type == 'error') {
            $message = 'Transaction failed, Ref: ' . $txRef;
            return Redirect::route('frontend.checkout.index')->with('error', $message);
        }

        if (!isset($txRef)) {

            $message = 'Unable to process';
            return Redirect::route('frontend.checkout.index')->with('error', $message);
        }

        $flutterAcc = json_decode($txRef->gatewayCurrency()->gateway_parameter);

        $query = array(
            "SECKEY" =>  $flutterAcc->secret_key,
            "txref" => $txRef
        );

        $data_string = json_encode($query);
        $ch = curl_init('https://api.flutterwave.com/v3/transactions/verify_by_reference');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer {SEC_KEY}"));
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if ($response->status == 'error') {
            $message = $response->message;
            return Redirect::route('frontend.checkout.index')->with('error', $message);
        }

        if ($response->data->status == "successful" && $response->data->chargecode == "00" && $order->amount == $response->data->amount && $order->status === 1) {
            $this->updatePaymentStatus($txRef);

            $message = 'Transaction was successful, Ref: ' . $txRef;
            
            return Redirect::route('frontend.checkout.index')->with('success', $message);
        }

        $message = 'Unable to process';

        return Redirect::route('frontend.checkout.index')->with('error', $message);
        
    }

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

        if ($res->data->status == "successful" && $res->data->amount == $order->amount && $res->data->currency == 'NGN') {
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
