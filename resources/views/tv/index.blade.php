@extends('layouts.main')

@section('content')

<div class="container mx-auto px-4 pt-16">
    <div class="popular-tv"> <!-- py-24 -->
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Show</h2>
        <div class="grid grid-cols-1 sm:grid-cls-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularTv as $tvShow)
                <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>

    <div class="now-playing-tv py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Show</h2>
        <div class="grid grid-cols-1 sm:grid-cls-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRatedplaying as $tvShow)
                <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
</div>
@endsection
