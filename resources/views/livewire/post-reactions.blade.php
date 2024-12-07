<div class="flex items-center">
    <button
        wire:click="react"
        class="px-2 py-1 rounded transition duration-200
            {{ $hasReacted ? 'bg-red-300 text-white' : 'text-gray-800 hover:bg-red-100' }}">
        ❤️
    </button>
    <p class="ml-2 text-gray-600 text-m font-bold">{{ $reactionsCount }} </p>
</div>
