<form action="/convert-audio" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="audio_file">Choisir un fichier audio :</label>
    <input type="file" name="audio_file" id="audio_file" required>
    
    <label for="format">Sélectionner le format de sortie :</label>
    <select name="format" id="format">
        <option value="mp3">MP3</option>
        <option value="wav">WAV</option>
        <option value="flac">FLAC</option>
        <option value="aac">AAC</option>
    </select>

    <button type="submit">Convertir</button>
</form>
