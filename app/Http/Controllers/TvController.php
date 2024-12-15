<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\ShowsTvViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $topRatedplaying = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedplaying,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function show($id)
    {
        $tvShow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new ShowsTvViewModel($tvShow);

        return view('tv.show', $viewModel);
    }
}
