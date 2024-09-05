<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AudioConversionController extends Controller
{
    public function convert(Request $request)
{
    $request->validate([
        'audio_file' => 'required|file|mimes:mp3,wav,ogg',
        'format' => 'required|string',
    ]);

    $file = $request->file('audio_file');

    // Envoyer le fichier à l'API
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('FREECONVERT_API_KEY'),
        // dd(),
    ])->post('https://api.freeconvert.com/v1/convert', [
        'file' => fopen($file->getPathname(), 'r'),
        'output_format' => $request->input('format'),
    ]);
    

    // Vérifiez si la conversion a réussi
    if ($response->successful()) {
        return redirect()->route('convert.audio.form')->with('message', 'Conversion réussie !');
    } else {
        return redirect()->route('convert.audio.form')->with('message', 'Erreur lors de la conversion : ' . $response->body());
    }
}


    public function convertApi(Request $request)
    {
        $request->validate([
            'audio_file' => 'required|file|mimes:mp3,wav,ogg',
            'format' => 'required|string',
        ]);

        $file = $request->file('audio_file');

        // Envoyer le fichier à l'API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('FREECONVERT_API_KEY'),
        ])->post('https://api.freeconvert.com/v1/convert', [
            'file' => fopen($file->getPathname(), 'r'),
            'output_format' => $request->input('format'),
        ]);

        // Vérifiez si la conversion a réussi
        if ($response->successful()) {
            return response()->json(['message' => 'Conversion réussie', 'data' => $response->json()], 200);
        } else {
            return response()->json(['message' => 'Erreur lors de la conversion', 'details' => $response->body()], 500);
        }
    }
}
