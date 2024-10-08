<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use Illuminate\Support\Arr;

class YouTubeController extends Controller
{
    public function fetchTrailers()
    {
        // Sélectionner aléatoirement 5 films depuis la base de données
        $movies = Movie::inRandomOrder()->limit(5)->get();

        // Clé API YouTube
        $apiKey = env('YOUTUBE_API_KEY');

        // Tableau pour stocker les vidéos de YouTube
        $videos = [];

        // Utilisation de Guzzle HTTP pour appeler l'API YouTube pour chaque titre
        $client = new Client();

        foreach ($movies as $movie) {
            $title = $movie->title;

            // Requête à l'API YouTube pour chaque titre de film
            $response = $client->get("https://www.googleapis.com/youtube/v3/search?key=$apiKey&part=snippet&type=video&maxResults=1&q=$title trailer");

            // Récupérer la première vidéo de la réponse
            $video = json_decode($response->getBody()->getContents());

            if (isset($video->items[0])) {
                $videos[] = $video->items[0];
            }
        }

        return view('trailers', compact('videos'));
    }
}
