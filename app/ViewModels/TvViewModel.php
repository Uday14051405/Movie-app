<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\TvShow;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedplaying;
    public $genres;

    public function __construct($popularTv, $topRatedplaying, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedplaying = $topRatedplaying;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedplaying()
    {
        return $this->formatTv($this->topRatedplaying);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        return collect($tv)->map(function ($tvShow) {

            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only(['poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres']);
        });
    }
}
