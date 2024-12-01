<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\OpenEmojiService;

class EmojiPicker extends Component
{
    public $perPage = 30;
    public $searchTerm = '';
    public $emojis = [];
    protected OpenEmojiService $emojiService;

    public function boot(OpenEmojiService $emojiService)
    {
        $this->emojiService = $emojiService;
    }

    public function updatedSearchTerm()
    {
        $this->searchEmojis();
    }

    public function searchEmojis()
    {
        \Log::info('searchEmojis called with: ' . $this->searchTerm);
        if (!empty($this->searchTerm)) {
            $this->emojis = $this->emojiService->searchEmojis($this->searchTerm);
        } else {
            $this->emojis = [];
        }
    }

    public function selectEmoji($character)
    {
        $this->dispatch('emojiSelected', $character);
    }

    public function render()
    {
        \Log::info('EmojiPicker component is rendering.');
        return view('livewire.emoji-picker');
    }
}
