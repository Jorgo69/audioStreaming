<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion Audio</title>
</head>
<body>
    <h1>Convertisseur Audio</h1>
    <form action="{{ route('convert.audio') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="audio_file">Choisissez un fichier audio :</label>
        <input type="file" name="audio_file" id="audio_file" required accept=".mp3,.wav,.ogg">
        
        <label for="format">Format de sortie :</label>
        <select name="format" id="format" required>
            <option value="mp3">MP3</option>
            <option value="wav">WAV</option>
            <option value="ogg">OGG</option>
        </select>
        
        <button type="submit">Convertir</button>
    </form>
    
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>

