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
        

        foreach ($array["results"] as $item ) {
            // $id = 1;
            $response = $client->request('GET', $item["url"]);
            $statusCodes = $response->getStatusCode(); // Mendapatkan status code dari response
            $bodys = $response->getBody();
            $arrays = json_decode($bodys, true);

            $url = $item["url"];
            $segments = explode('/', trim($url, '/'));
            $id = array_pop($segments);
            // echo "<pre>";print_r($nilai);die;

            $totalStat = 0;
                foreach ($arrays["stats"] as $stat) {
                    
                    if (floatval($stat['effort']) >= 1) {
                        # code...
                        $totalStat += floatval($stat['base_stat']);
                        // echo "<pre>";print_r($totalStat);die;
                    };
                    # code...
                    
                    // echo "<pre>";print_r($id);die;

                }

                foreach ($arrays["abilities"] as $atrbt) {
                    
                    if ($atrbt['is_hidden'] == 0) {
                        // echo "<pre>";print_r($atrbt['ability']['name']);die;

                        $form_dataatr = array(
                            'name' => $atrbt['ability']['name'],
                            'pokemon_id' => $id,
                        );
                        abilities::create($form_dataatr);
                    };
                   
                }









                // echo "<pre>";print_r($arrays["weight"]);die;
               
                $form_data = array(
                    'name' => $item['name'],
                    'base_experience' => $arrays['base_experience'],
                    'weight' => $arrays['weight'],
                    'start_count' => $totalStat,
                    'image_url' => $arrays['sprites']['back_default']
                );
                Pokemons::create($form_data);
                $id++;
            // $model = new Pokemons();
            // $model->name = $item['name'];
            // $model->base_experience = $arrays['base_experience'];
            // $model->weight = $arrays['weight'];
            // $model->start_count = $totalStat;
            // $model->image_url = "ada";
            // $model->save();
        }
        // foreach ($array as &$item) {
        //     $item["weight"] = ; // Menambahkan elemen "weight" dengan nilai 10
        // }

        // return $body;


    // }
    
    // return "asdas";

 
}

public function att(Request $request){

    $poke = Pokemons::all();
    return view('poke', ['poke' => $poke]);
}


}