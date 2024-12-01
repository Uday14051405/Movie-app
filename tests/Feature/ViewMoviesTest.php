<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{

    public function test_the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),

            'https://api.themoviedb.org/3/movie/now_playing' => Http::response([
                'results' => [],
            ], 200)
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
    }

    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=Moana 2' => $this->fakePopularMovies(),
        ]);

        Livewire::test('seach-dropdown')
            ->assertDonSee('Moana 2')
            ->set('search', 'Moana 2')
            ->assertSee('Moana 2');
    }

    public function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/tElnmtQ6yz1PjN1kePNl8yMSb59.jpg",
                    "genre_ids" => [
                        0 => 16,
                        1 => 12,
                        2 => 10751,
                        3 => 35,
                    ],
                    "id" => 1241982,
                    "original_language" => "en",
                    "original_title" => "Moana 2",
                    "overview" => "After receiving an unexpected call from her wayfinding ancestors, Moana journeys alongside Maui and a new crew to the far seas of Oceania and into dangerous, long-lost waters for an adventure unlike anything she's ever faced.",
                    "popularity" => 3633.267,
                    "poster_path" => "/4YZpsylmjHbqeWzjKpUEF8gcLNW.jpg",
                    "release_date" => "2024-11-27",
                    "title" => "Moana 2",
                    "video" => false,
                    "vote_average" => 7.268,
                    "vote_count" => 95,
                ],
            ],

        ], 200);
    }

    /**
     * A basic test example.
     */
    // public function test_the_application_returns_a_successful_response(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
