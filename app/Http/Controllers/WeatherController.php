<?php
// app/Http/Controllers/WeatherController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{   
    // Método para mostrar el formulario
    public function showForm()
    {
        // Retorna la vista del formulario de clima
        return view('weather.form');
    }

    // Método para obtener el clima
    public function fetchWeather(Request $request)
    {
        // Obtener latitud y longitud desde la solicitud
        $lat = $request->input('lat');
        $lon = $request->input('lon');  
    
        // Validar latitud y longitud
        $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        // Crear cliente Guzzle y preparar solicitud
        $client = new Client();
        $response = $client->get(config('services.openweather.url'), [
            'query' => [
                'lat' => $lat, // Usar la variable definida
                'lon' => $lon, // Usar la variable definida
                'appid' => config('services.openweather.key'),
            ]
        ]);

        // Convertir la respuesta JSON en un array PHP
        $data = json_decode($response->getBody(), true);

        return view('weather.form', compact('data'));
    }
}

