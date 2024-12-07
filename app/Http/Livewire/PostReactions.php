<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostReactions extends Component
{
    public $reactionable; 
    public $reactionsCount;

    public function mount($reactionable)
    {
        $this->reactionable = $reactionable;
        $this->reactionsCount = $reactionable->reactions()->count();
    }

    public function react()
    {
        $existingReaction = $this->reactionable->reactions()
            ->where('chat_user_id', auth()->id())
            ->first();

        if ($existingReaction) {
            return; 
        }

        $this->reactionable->reactions()->create([
            'chat_user_id' => auth()->id(),
        ]);

        $this->reactionsCount = $this->reactionable->reactions()->count();
    }

    public function render()
    {
        return view('livewire.post-reactions');
    }
}

