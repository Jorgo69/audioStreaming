<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Board') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('converting')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
