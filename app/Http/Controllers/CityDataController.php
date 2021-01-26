<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Cities;
use Illuminate\Support\Facades\DB;

class CityDataController extends Controller
{
    function getCities(){
        $cities=Cities::all();
        return $cities;
    }

    function getWeather(){

        $cities=Cities::all();

        foreach ($cities as $city){
            $getWeather=Http::get("http://api.openweathermap.org/data/2.5/weather?q=".$city['name']."&appid=bf65d8b174418831a16055a19f50144f")->body();
            $getWeather=json_decode($getWeather,true);
            if($getWeather['cod']==200){
                DB::table('cities_weather')
                    ->updateOrInsert(
                        ['city_id' => $city['id']],
                        [
                            'time'=>date('Y/m/d H:i:s', (time()+$getWeather['timezone'])),
                            'temp'=>round($getWeather['main']['temp']-273),
                            'pressure'=>$getWeather['main']['pressure'],
                            'humidity'=>$getWeather['main']['humidity'],
                            'temp_min'=>round($getWeather['main']['temp_min']-273),
                            'temp_max'=>round($getWeather['main']['temp_max']-273),
                        ]
                    );
            }
        }
        $weathers=DB::table('cities')
            ->leftJoin('cities_weather', 'cities.id', '=', 'cities_weather.city_id')
            ->get();

        return $weathers;


    }

}
