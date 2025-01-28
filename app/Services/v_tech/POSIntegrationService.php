<?php

namespace App\Services\v_tech;

use App\Models\Order;
use App\Models\User;
use App\Models\VtechUser;
use GuzzleHttp\Client;


class POSIntegrationService
{
    private $httpClient;
    protected $credentials;
    private $token;


    public function __construct(Client $httpClient, $ip = null)
    {
        $this->credentials = config('v_tech.info.url');
        if (empty($this->credentials)) {
            throw new \Exception("Please set V_TECH_API_INFO credentials in env", 1);
        }
        $this->httpClient = $httpClient;
        $this->ip = $ip;
        $this->token = app()->make(TokenServices::class)->get();
    }

    public function createUser(Order $order)
    {
        if ($order->user->vtechTrait && $order->user->vtechTrait->exists()) {
            return true;
        }
        $data = [
            'P_STAID' => 1,
            'P_KOGID' => $order->user->id,
            'P_PhoneNumber' => $order->user->phone ?? $order['phone'],
            'P_FirstName' => $order->user->name,
            'P_LastName' => $order->user->name,
            'P_Address1' => $order->user->zone->AddresAr,
            'P_Address2' => $order->user->zone->AddresEn,
            'P_City' => $order->zone->region->name_en,
            'P_Email' => $order->user->email,
            'P_Description' => 'create from webSite',
            'P_DateOfBirth' => $order->user->BirthDate,
            'P_PostalCode' => '962',
            'P_CardNumber' => $order->user->id,

        ];
        $response = $this->postAPI($data, 'AddContractor');

        if ($response->R_IsSuccess == true) {
            $vtech = new VtechUser(['VtechID' => $response->R_Data, 'UserID' => $order->user->id]);
            $vtech->save();
        }
        return $response;
    }

    public function updateUser(User $user)
    {

        $r_data = $this->getContractorDetails($user);
        $data = [
            'P_STAID' => 1,
            'P_KOGID' => $user->vtechTrait->VtechID,
            'P_PhoneNumber' => $user->phone ?? $r_data->P_PhoneNumber,
            'P_FirstName' => $user->name,
            'P_LastName' => $user->name,
            'P_Address1' => $user->zone->AddresAr,
            'P_Address2' => $user->zone->AddresEn,
            'P_City' => $user->zone->region->name_en,
            'P_Email' => $user->email,
            'P_Description' => 'create from webSite',
            'P_DateOfBirth' => $user->BirthDate,
            'P_PostalCode' => '962',
            'P_CardNumber' => $user->id,
        ];
        $response = $this->postAPI($data, 'UpdateContractor');
        if ($response->R_IsSuccess == true) {
            $vtech = VtechUser::where('UserID', $user->id)->first();
            if ($vtech) {
                $vtech->VtechID = $response->R_Data;
                $vtech->save();
            }

        }
        return $response;
    }

    public function getContractorDetails(User $user)
    {
        if ($user->vtechTrait) {
            $P_KONID = $user->vtechTrait->VtechID;
        } else {
            return false;
        }
        $response = $this->getAPI('GetContractorDetails?P_KONID=' . $P_KONID);
        return $response->R_Data;
    }

    public function openBill(){
        $item_details=[

        ];
        $item=[

        ];
        $data=[
            'P_StationID',
            'P_Description',
            'P_AccountOpenTypeID',
            'P_CustomerID',
            'P_AddressDetails',
            'P_Phone',
            'P_ItemList'=>$item,
              ];
    }

    public function postAPI(array $data, string $action)
    {
        $request = (string)$this->httpClient->post($this->credentials . 'api/POSIntegration/' . $action,
            [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $this->token
                ]
            ],
        )->getBody();
        $response = json_decode($request);
        if (!$response) {
            throw new \Exception("Failed to set add contractor : ", 1);
        }
        return $response;
    }

    public function getAPI(string $action)
    {
        $request_api = (string)$this->httpClient->get($this->credentials . 'api/POSIntegration/' . $action,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $this->token
                ]
            ],
        )->getBody();
        $response = json_decode($request_api);
        if (!$response || !$response->R_IsSuccess) {
            throw new \Exception("Failed to set add contractor : ", 1);
        }
        return $response;
    }
}
