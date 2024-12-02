<div class="max-w-lg mx-auto p-4 bg-white rounded shadow">
    <!-- Search Input -->
    <div class="mb-4 flex justify-center">
        <input 
        type="text" 
        wire:model.live.debounce.400ms="searchTerm" 
        autocomplete="off"
        placeholder="Search emojis by name..."
        class="emoji-search-input w-full sm:w-64 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Emoji Grid -->
    <div class="emoji-picker-container grid grid-flow-col auto-cols-max gap-2 overflow-x-auto h-120">
        @php
            $validEmojis = collect($emojis)->filter(function ($emoji) {
                return is_array($emoji) && isset($emoji['character'], $emoji['unicodeName']);
            });
        @endphp
        @forelse ($validEmojis as $emoji)
            @if (is_array($emoji) && isset($emoji['character'], $emoji['unicodeName']))     
                <div wire:click="selectEmoji('{{ $emoji['character'] }}')"
                    class="emoji-item text-2xl cursor-pointer transition-transform transform hover:scale-125"
                    title="{{ $emoji['unicodeName'] }}">
                    {!! $emoji['character'] !!}
                </div>
            @else
                <p class="col-span-6 sm:col-span-8 md:col-span-10 text-center text-gray-500">
                    Invalid emoji data
                </p>
            @endif
        @empty
            <p class="flex items-center col-span-full h-full text-gray-500 text-center">No emojis found</p>
        @endforelse
    </div>

    <!-- Load More Button -->
    @if (count($emojis) % $perPage === 0 && count($emojis) > 0)
        <div class="mt-4 text-center">
            <button wire:click="loadMore"
                class="load-more-button px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                Load More
            </button>
        </div>
    @endif
</div>