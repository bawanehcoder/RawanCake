<?php

namespace App\Services\Payment;

use GuzzleHttp\Client;

class PaytabsService
{


    public function __construct()
    {
        $this->baseUrl = PaytabsConfig::getBaseApiUrl();
        $this->profileID = PaytabsConfig::getProfileID();
        $this->apiKey = PaytabsConfig::getApiToken();
        $this->callback=PaytabsConfig::getSuccessfulTransactionCallbackUrl();
        $this->failedCallback=PaytabsConfig::getFailedTransactionCallbackUrl();
    }

    public function getDataByOrderId($paymentOrder)
    {

        $data =   [
            "tran_type"=> "sale",
            "tran_class"=> "ecom",
            "cart_id"=> $paymentOrder->id.'-'.$paymentOrder->user->id,
            "cart_currency"=> "JOD",
            "cart_amount"=> $paymentOrder->Total,
            "cart_description"=>"'" .$paymentOrder->user->id."'",
            "paypage_lang"=> "en",
            "customer_details"=> [
                "name"=>$paymentOrder->user->name ,
                "email"=> $paymentOrder->user->email,
                "phone"=> $paymentOrder->Phone ,
                "street1"=> $paymentOrder->zone->AddresEn,
                "city"=> $paymentOrder->zone->region->name_en,
                "state"=> "JO",
                "country"=> "JO",
                "zip"=> "962"
            ],
            "shipping_details"=> [
                "name"=> $paymentOrder->user->name,
                "email"=> $paymentOrder->user->email,
                "phone"=> $paymentOrder->Phone,
                "street1"=> $paymentOrder->zone->AddresEn,
                "city"=> $paymentOrder->zone->region->name_en,
                "state"=> "JO",
                "country"=> "JO",
                "zip"=> "962"
            ],
            "callback"=> $this->callback,
            "return"=> $this->failedCallback
        ];
        return $data;
    }
    function send_api_request($request_url, $data, $request_method = null)
    {
        $data['profile_id'] = $this->profileID;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $this->baseUrl  . $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => isset($request_method) ? $request_method : 'POST',
            CURLOPT_POSTFIELDS => json_encode($data, true),
            CURLOPT_HTTPHEADER => array(
                'authorization:' . $this->apiKey,
                'Content-Type:application/json'
            ),
        ));
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $response;
    }

    function is_valid_redirect($post_values)
    {
        // dd($post_values);
        try {
            $serverKey = $this->apiKey;
        // Request body include a signature post Form URL encoded field
        // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
        $requestSignature = $post_values["signature"];
        unset($post_values["signature"]);
        $fields = array_filter($post_values);
        // Sort form fields
        ksort($fields);
        // Generate URL-encoded query string of Post fields except signature field.
        $query = http_build_query($fields);
        $signature = hash_hmac('sha256', $query, $serverKey);
        if (hash_equals($signature, $requestSignature) === TRUE) {
            // VALID Redirect
            return true;
        } else {
            // INVALID Redirect
            return false;
        }
        } catch (\Throwable $th) {
            return false;

        }
    }

    function getBaseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF'];
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'https://';
        $current_directory = substr(strrchr($pathInfo['dirname'],'/'), 1);
        $parent_directory = substr($pathInfo['dirname'], 0, - strlen($current_directory));
        return   $protocol.$hostName.'/'.$current_directory.'/';
    }


}
