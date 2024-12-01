<div class="relative mt-3 md:mt-0">
    <input wire:model.live.debounce.500ms="search" type="text"
        class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search">
    <div class="absolute top-0">
        <svg class="mt-1 ml-1" fill="#f0f8ff" width="25px" height="25px" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M20.207 18.793L16.6 15.184a7.027 7.027 0 1 0-1.416 1.416l3.609 3.609a1 1 0 0 0 1.414-1.416zM6 11a5 5 0 1 1 5 5 5.006 5.006 0 0 1-5-5z"
                fill="#fff"></path>
        </svg>
    </div>

    <div wire:loading class="spinner top-1 right-0 mr-4 mt-3"></div>
    @if(strlen($search) >= 2)
    <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4">
        @if($searchResults->count() > 0)
        <ul>
            @foreach($searchResults as $result)
            <li class="border-b border-gray-700">
                <a href="#" class="block hover:bg-gray-700 px-3 py-3 flex items-center">
                    @if($result['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" srcset=""
                        class="w-8">
                    @else
                    <img src="https://via.placeholde.com/50*75" alt="poster" srcset="" class="w-8">
                    @endif
                    <span class="ml-4">{{ $result['title'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="px-3 py-3">No results for "{{ $search}}"</div>
        @endif
    </div>
    @endif
</div>
