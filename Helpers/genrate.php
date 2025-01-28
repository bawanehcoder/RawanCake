<?php
if (!function_exists('random_password')) {
    function random_password($le,$type)
    {
        switch ($type){
            case 0:
                $alphabet = "0123456789";
                break;
            case 1:
                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                break;
        }

        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $le; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}


if (!function_exists('callAPI')) {
    function callAPI($post_url, $post_header, $post_fields, $post_type = 'GET')
    {
        // setup cURL request
        $ch = curl_init();

        // do not return header information
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // submit data in header if specified
        if (is_array($post_header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
        }

        // do not return status info
        curl_setopt($ch, CURLOPT_VERBOSE, 0);

        // return data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // cancel ssl checks
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // if using GET, POST or PUT
        if ($post_type == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_fields));
        } elseif ($post_type == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
        } elseif ($post_type == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            if ($post_fields) {
                $post_url .= '?' . http_build_query($post_fields);
            }
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            if ($post_fields) {
                $post_url .= '?' . http_build_query($post_fields);
            }
        }
        // specified endpoint
        curl_setopt($ch, CURLOPT_URL, $post_url);
        // execute cURL request
        $response = curl_exec($ch);
        // return errors if any
        if ($response === false) {
            $output = curl_error($ch);
        } else {
            $output = $response;
        }
        // close cURL handle
        curl_close($ch);

        // dd(json_decode($output));

        // output
        return json_decode($output);
    }
}
