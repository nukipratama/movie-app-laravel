<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $rawMovies = null;
        $data = [];

        if ($request->query('title')) {
            $rawMovies = Http::get("https://imdb-api.com/API/AdvancedSearch/k_ed9sro1k?title=" . $request->query('title') . "&title_type=tv_movie");
        } else {
            $rawMovies = Http::get("https://imdb-api.com/en/API/InTheaters/k_ed9sro1k");
        }

        if ($rawMovies) {
            $data = array_map(
                function (array $subArr) {
                    return [
                        'id' => $subArr['id'],
                        'title' => $subArr['title'],
                        'imdbRating' => $subArr['imDbRating'],
                        'image' => $subArr['image'],
                        'plot' => $subArr['plot'],
                    ];
                },
                isset($rawMovies['items']) ? $rawMovies['items'] : $rawMovies['results']
            );
        }

        return response()->json([
            'code' => HttpFoundationResponse::HTTP_OK,
            'message' => 'success',
            'data' => $data
        ], HttpFoundationResponse::HTTP_OK);
    }

    public function show($id)
    {
        $movie = Http::get("https://imdb-api.com/en/API/Title/k_ed9sro1k/" . $id);
        $data = [
            'id' => $movie['id'],
            'title' => $movie['title'],
            'imdbRating' => $movie['imDbRating'],
            'image' => $movie['image'],
            'plot' => $movie['plot'],
            'awards' => $movie['awards'],
            'directors' => $movie['directors'],
            'writers' => $movie['writers'],
            'stars' => $movie['stars'],
            'genreList' => $movie['genreList'],
            'companyList' => $movie['companyList'],
        ];

        if ($data['title'] === null) {
            return response()->json([
                'code' => HttpFoundationResponse::HTTP_NOT_FOUND,
                'message' => 'failed',
                'data' => null
            ], HttpFoundationResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'code' => HttpFoundationResponse::HTTP_OK,
            'message' => 'success',
            'data' => $data
        ], HttpFoundationResponse::HTTP_OK);
    }
}
