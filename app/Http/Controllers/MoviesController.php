<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    //
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        // dd($popularMovies);

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        // $genres = collect($genresArray)->mapWithKeys(function ($genre) {
        //     return [$genre['id'] => $genre['name']];
        // });

        // return view('index', [
        //     'popularMovies' => $popularMovies,
        //     'nowPlayingMovies' => $nowPlayingMovies,
        //     'genres' => $genres,
        // ]);

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('movies.index', $viewModel);
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        // dump($movie);

        // return view('show',[
        //     'movie' => $movie,
        // ]);

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }
}
