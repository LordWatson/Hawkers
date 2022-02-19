<?php

namespace App\Integrations\NutritionXApi\V1;

use App\Helpers\generalHelper;
use DB;
use Illuminate\Http\Request;

class NutritionXApi{

    private $queryFields;
    private $baseUrl;

    function __construct()
    {
        // Stored the API in the .env but it's:
        // 36fdf376e8mshe2b448c1693c63ap1fa053jsn604bf09668fe
        $this->apiKey = env('NUTRITIONX_API_KEY');

        $this->baseUrl = 'https://nutritionix-api.p.rapidapi.com/v1_1';

        $this->queryFields = '?fields=item_name,item_id,brand_name,nf_calories,nf_total_fat,nf_protein';
    }

    function curl($endpoint, $query){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . $endpoint . $query . $this->queryFields,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: nutritionix-api.p.rapidapi.com",
                "x-rapidapi-key: 36fdf376e8mshe2b448c1693c63ap1fa053jsn604bf09668fe",
            ]
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    function queryFoodItem($queryStr)
    {
        $query = urlencode($queryStr);
        return self::curl('/search/', $query);
    }
}
