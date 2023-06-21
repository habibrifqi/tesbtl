<?php

namespace App\Http\Controllers;

use App\Models\abilities;
use App\Models\Pokemons;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class PokemonsController extends Controller
{
    //
function index(){

    $pp = 'pokemon';
    // for ($i=1; $i <= 200 ; $i++) { 
        # code...




        
        $client = new Client();
        $response = $client->request('GET', "https://pokeapi.co/api/v2/pokemon/?limit=200");
        $statusCode = $response->getStatusCode(); // Mendapatkan status code dari response
        $body = $response->getBody();
        $array = json_decode($body, true);

        // echo "<pre>";print_r($array['results']);die;
        
        $id = 1;
        foreach ($array["results"] as $item ) {
            $response = $client->request('GET', $item["url"]);
            $statusCodes = $response->getStatusCode(); // Mendapatkan status code dari response
            $bodys = $response->getBody();
            $arrays = json_decode($bodys, true);
            // echo "<pre>";print_r($arrays["weight"]);die;

            if (floatval($arrays['weight']) >= 100) {
                          
                $url = $item["url"];
                $segments = explode('/', trim($url, '/'));
                // $id = array_pop($segments);
                // echo "<pre>";print_r($nilai);die;

                $totalStat = 0;
                foreach ($arrays["stats"] as $stat) {
                    
                    if (floatval($stat['effort']) >= 1) {
                        $totalStat += floatval($stat['base_stat']);
                    };

                }

                foreach ($arrays["abilities"] as $atrbt) {
                    
                    if ($atrbt['is_hidden'] == 0) {
                        $form_dataatr = array(
                            'name' => $atrbt['ability']['name'],
                            'pokemon_id' => $id,
                        );
                        abilities::create($form_dataatr);
                    };
                   
                }
                $form_data = array(
                    'name' => $item['name'],
                    'base_experience' => $arrays['base_experience'],
                    'weight' => $arrays['weight'],
                    'start_count' => $totalStat,
                    'image_url' => $arrays['sprites']['back_default']
                );
                Pokemons::create($form_data);
            
                $id +=1;
            }
            
        }

 
}

public function att(Request $request){

    $poke = Pokemons::all();
    return view('poke', ['poke' => $poke]);
}


}