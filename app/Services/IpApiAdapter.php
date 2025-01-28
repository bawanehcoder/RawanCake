<?php

namespace App\Services;
use GuzzleHttp\Client;
class IpApiAdapter
{
    private $ip;
    private $httpClient;
    private $country;
    private $countryCode;
    private $city;
    private $timezone;
    protected $ipInfoFetched = false;
    protected $credentials;
    public function __construct(Client $httpClient, $ip = null){

        $this->credentials =  env('IP_API_INFO');
        return false; // temp
        if(empty( $this->credentials )){
            throw new \Exception("Please set IP_API_INFO credentials in env", 1);
        }
        $this->ip = $ip ?? $this->detectUserIp();
        $this->httpClient = $httpClient;


    }
    public function detectUserIp(){
        return $_SERVER["HTTP_CF_CONNECTING_IP"] ?? \Request::ip() ?? $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    }

    public function getIpInfo(){

        //if ip info was fetched before, stop
        if($this->ipInfoFetched) return false;
        //check first if ip info saved in cache
        $response = \Cache::remember('ip-info-' . $this->getIp(), 60*60*10, function () {
            //fetch ip info

            return (string) $this->httpClient->request('GET', 'http://ip-api.com/json/' . $this->ip, [
                'query' => [
                    // 'key' => $this->credentials
                ],
            ])->getBody();
       });

        $response = json_decode($response);
        if($response->status == 'fail'){
            throw new \Exception("Failed to get ip info: " . $this->ip, 1);
        }
        $this->country = $response->country;
        $this->countryCode = $response->countryCode;
        $this->city = $response->city;
        $this->timezone = $response->timezone;
        $this->ipInfoFetched = true;
        return $this;
    }



    public function getIp(){
        return $this->ip;
    }

    public function getCountry(){
        return $this->country;
    }

    public function getCountryCode(){
        return $this->countryCode;
    }

    public function getCity(){
        return $this->city;
    }

    public function getTimezone(){
        return $this->timezone;
    }
}
