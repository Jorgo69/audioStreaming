<?php

namespace App\Http\Controllers;

use App\Models\AudioConvertion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AudioConvertionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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

        // Commande pour convertir le fichier audio avec SoX
        $commandSox = "sox {$inputFilePath} ". "-c 2 -C 128" ." {$outputFilePath} 2>&1";
        exec($commandSox, $output, $returnVar);
        // sox input.wav -c 2 -C 128 output.mp3

        // Afficher les erreurs pour le diagnostic
        if ($returnVar !== 0) {
            return response()->json(['message' => 'Erreur lors de la conversion audio.', 'error' => implode("\n", $output)], 500);
        }

        return response()->download($outputFilePath)->deleteFileAfterSend(true);
    }

    public function convertWithLame(Request $request)
    {
        // Validation du fichier audio
        $request->validate([
            'audio_file' => 'required|file|mimes:mp2,mp3,wav|max:20480', // LAME prend en entrée des fichiers WAV
            'format' => 'required|in:mp3'
        ]);

        $inputFile = $this->storeAudio($request->file('audio_file'), $request);
if (!$inputFile) {
    return response()->json(['message' => 'Erreur lors du téléchargement du fichier audio.'], 500);
}

$inputFilePath = storage_path('app/public/' . $inputFile);
$outputFormat = $request->input('format');
$outputFileName = 'fichier_sortie.' . $outputFormat;
$outputFilePath = storage_path('app/public/audios/' . $outputFileName);

// Vérification des chemins de fichiers
if (!file_exists($inputFilePath)) {
    return response()->json(['message' => 'Le fichier d\'entrée n\'existe pas.'], 400);
}

// Commande pour convertir le fichier audio avec SoX
$commandLame = "\"C:\\Program Files (x86)\\sox-14-4-2\\sox.exe\" \"$inputFilePath\" -c 2 -C 128 \"$outputFilePath\" 2>&1";

// Exécuter la commande
exec($commandLame, $output, $returnVar);

// Vérifier le résultat de la commande
if ($returnVar !== 0) {
    return response()->json([
        'message' => 'Erreur lors de la conversion du fichier audio.',
        'output' => implode("\n", $output), // Afficher la sortie de l'erreur
    ], 500);
}

// Si tout s'est bien passé, retourner le chemin du fichier de sortie
return response()->json(['message' => 'Conversion réussie.', 'output_file' => $outputFilePath], 200);




        // Afficher les erreurs pour le diagnostic
        if ($returnVar !== 0) {
            return response()->json(['message' => 'Erreur lors de la conversion audio.'], 500);
        }

        return response()->json(['message' => 'Sa marche lors de la conversion audio.'], 500);
        return response()->download($outputFilePath)->deleteFileAfterSend(true);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
