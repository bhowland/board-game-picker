<?php
function rest_call($method, $url, $data = false, $contentType= false, $token = false)
{
    $curl = curl_init();

    if($token){ //Add Bearer Token header in the request
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$token
        ));
    }

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data){
                if($contentType){
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: '.$contentType
                    ));
                }
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

?>