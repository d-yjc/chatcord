<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\OpenEmojiService;

class EmojiPicker extends Component
{
    public $perPage = 30;

    public $searchTerm = '';
    public $emojis     = [];

    public function mount()
    {
        \Log::info('EmojiPicker component has mounted.');
    }


    public function updatedSearchTerm()
    {
        $this->searchEmojis();
    }

    public function searchEmojis()
    {
        \Log::info('searchEmojis called with: ' . $this->searchTerm);
        if (!empty($this->searchTerm)) {
            $emojiService = app(OpenEmojiService::class);
            $this->emojis = $emojiService->searchEmojis($this->searchTerm);
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
