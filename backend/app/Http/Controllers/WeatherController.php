<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $logs = Weather::latest()->take(10)->get();
        return view('home', compact('logs'));
    }

    public function search(Request $request)
    {
        $city = $request->input('city');

        if (!$city) {
            return redirect('/')->with('error', 'Please enter a city name.');
        }

        $apiKey = env('OPENWEATHER_API_KEY');
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        if ($response->failed()) {
            return redirect('/')->with('error', 'City not found.');
        }

        $data = $response->json();
        $temp = $data['main']['temp'];
        $humidity = $data['main']['humidity'];

        // Call Flask API for prediction
        try {
            $flaskResponse = Http::post("http://127.0.0.1:5000/predict", [
                'temp' => $temp,
                'humidity' => $humidity
            ]);

            $prediction = $flaskResponse->json()['prediction'] ?? 'N/A';
        } catch (\Exception $e) {
            $prediction = 'Flask service unavailable';
        }

        // Store in DB
        Weather::create([
            'city' => ucfirst($city),
            'temperature' => $temp,
            'recorded_at' => now()
        ]);

        return redirect('/')->with('success', "Weather for $city: {$temp}°C, Prediction: {$prediction}");
    }
}

