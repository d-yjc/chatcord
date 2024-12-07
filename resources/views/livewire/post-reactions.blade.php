<div class="flex items-center">
    <p class="ml-1 mr-2 text-gray-600 text-m font-bold">{{ $reactionsCount }}</p>
    <button
        wire:click="react"
        class="px-2 py-1 rounded transition duration-200 bg-red-100
            {{ $hasReacted ? 'bg-red-300 text-white' : 'text-gray-800 hover:bg-red-200' }}">
        ❤️
    </button>
</div>
