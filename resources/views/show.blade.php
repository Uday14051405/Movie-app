@extends('layouts.main')

@section('content')

<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{'https://image.tmdb.org/t/p/w300/' . $movie['poster_path']}}" alt="parasite" class="w-64 lg:w-96">
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">
                    <defs></defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path d="M 45.002 75.502 c 2.862 0 5.72 0.684 8.326 2.051 l 19.485 10.243 l -3.721 -21.678 c -1.002 -5.815 0.926 -11.753 5.164 -15.877 L 90 34.895 l -21.768 -3.161 c -5.838 -0.85 -10.884 -4.514 -13.499 -9.806 L 44.998 2.205 l -9.73 19.717 c -2.615 5.292 -7.661 8.962 -13.499 9.811 L 0 34.895 L 15.749 50.25 c 4.224 4.111 6.156 10.044 5.16 15.863 l -3.721 21.682 l 19.466 -10.238 C 39.268 76.19 42.135 75.502 45.002 75.502 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,207,100); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                </svg>
                <span class="ml-1">{{$movie['vote_average'] * 10}}%</span>
                <span class="mx-2">|</span>
                <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
                <span class="mx-2">|</span>
                <span>
                    @foreach ($movie['genres'] as $genre)
                    {{$genre['name']}}@if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>
            <p class="text-gray-300 mt-8">
                {{  $movie['overview'] }}
            </p>

            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Crew</h4>
                <div class="flex mt-4">
                    @foreach ($movie['credits']['crew'] as $crew)
                    @if ($loop->index < 2)
                    <div class="mr-8">
                        <div>{{$crew['name']}}</div>
                        <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            @if (count($movie['videos']['results']) > 0)
                <div class="mt-12">
                    <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key']}}" class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-white hover:bg-orange-600 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512">
                            <path fill-rule="nonzero" d="M255.99 0c70.68 0 134.7 28.66 181.02 74.98C483.33 121.3 512 185.31 512 256c0 70.68-28.67 134.69-74.99 181.01C390.69 483.33 326.67 512 255.99 512S121.3 483.33 74.98 437.01C28.66 390.69 0 326.68 0 256c0-70.67 28.66-134.7 74.98-181.02C121.3 28.66 185.31 0 255.99 0zm77.4 269.81c13.75-8.88 13.7-18.77 0-26.63l-110.27-76.77c-11.19-7.04-22.89-2.9-22.58 11.72l.44 154.47c.96 15.86 10.02 20.21 23.37 12.87l109.04-75.66zm79.35-170.56c-40.1-40.1-95.54-64.92-156.75-64.92-61.21 0-116.63 24.82-156.74 64.92-40.1 40.11-64.92 95.54-64.92 156.75 0 61.22 24.82 116.64 64.92 156.74 40.11 40.11 95.53 64.93 156.74 64.93 61.21 0 116.65-24.82 156.75-64.93 40.11-40.1 64.93-95.52 64.93-156.74 0-61.22-24.82-116.64-64.93-156.75z" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cls-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($movie['credits']['cast'] as $cast)
                @if ($loop->index < 5)
                    <div class="mt-8">
                        <a href="#">
                            <img src="{{'https://image.tmdb.org/t/p/w200/' . $cast['profile_path']}}" alt="parasite" class="w-64 lg:w-96">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover: text-gray:300">{{$cast['name']}}</a>
                            <div class="text-gray-400 text-sm">
                                {{$cast['character']}}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            
            
        </div>
    </div>
</div>

<div class="movie-images">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($movie['images']['backdrops'] as $image)
                @if ($loop->index < 9)
                    <div class="mt-8">
                        <img src="{{'https://image.tmdb.org/t/p/w500/' . $image['file_path']}}" alt="parasite" class="w-full">
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
