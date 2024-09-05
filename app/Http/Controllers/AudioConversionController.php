<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AudioConversionController extends Controller
{
    private function storeAudio($audio, $request)
    {
        $audio = $request->file('audio_file');
        $path = 'audios';

        if($audio !== null && !$audio->getError()){
            $audioName = Carbon::now()->timestamp . '.' . $request->audio_file->getClientOriginalExtension();
            // $audioName = $audio . '.' . $request->audio_file->getClientOriginalExtension();
            $audioPath = $audio->storeAs($path, $audioName, 'public');
            return $audioPath;
        }
        
        return null;
    }
    
    public function convert(Request $request)
    {
        // Validation du fichier audio
        $request->validate([
            'audio_file' => 'required|file|mimes:mp2,wav,mp3,flac,aac|max:20480',
            'format' => 'required|in:mp3,wav,flac,aac'
        ]);

        $inputFile = $this->storeAudio($request->file('audio_file'), $request);
        if (!$inputFile) {
            return response()->json(['message' => 'Erreur lors du téléchargement du fichier audio.'], 500);
        }

        $inputFilePath = storage_path('app/public/' . $inputFile);
        $outputFormat = $request->input('format');
        $outputFileName = 'fichier_sortie.' . $outputFormat;
        $outputFilePath = storage_path('app/public/audios/' . $outputFileName);

        // Commande pour convertir le fichier audio avec GStreamer
        $commandGst = "gst-launch-1.0 filesrc location=\"$inputFilePath\" ! decodebin ! audioconvert ! audioresample ! queue ! $outputFormatenc ! filesink location=\"$outputFilePath\" 2>&1";
        exec($commandGst, $output, $returnVar);

        // Afficher les erreurs pour le diagnostic
        if ($returnVar !== 0) {
            return response()->json(['message' => 'Erreur lors de la conversion audio.', 'error' => implode("\n", $output)], 500);
        }

        return response()->download($outputFilePath)->deleteFileAfterSend(true);
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
