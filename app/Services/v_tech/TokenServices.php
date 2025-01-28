<?php

namespace App\Services\v_tech;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class TokenServices
{
    private $httpClient;
    protected $credentials;
    private $token;
    public function __construct(Client $httpClient){
        $this->credentials = config('v_tech.info.url');

        if(empty( $this->credentials )){
            throw new \Exception("Please set V TECH API INFO credentials in config", 1);
        }
        $this->httpClient = $httpClient;
    }
    public function get(){
        //check  saved in cache
        $response = Cache::remember('token-info' , 1799, function () {
            return (string) $this->httpClient->post( $this->credentials . 'token', [
                'form_params'=> [
                    'grant_type'=> config('v_tech.info.grant_type'),
                    'username'=>config('v_tech.info.username'),
                    'password'=>config('v_tech.info.password')
                ],
            ])->getBody();
        });
        $response = json_decode($response);
        if(!$response){
            throw new \Exception("Failed to get token : ", 1);
        }
        $this->token=$response->token_type." ".$response->access_token;
        return $this->token;
    }
}
