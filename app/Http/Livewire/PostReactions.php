<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostReactions extends Component
{
    public $reactionable;
    public $reactionsCount;
    public $hasReacted;

    public function mount($reactionable)
    {
        $this->reactionable = $reactionable;
        $this->reactionsCount = $reactionable->reactions()->count();
        $this->hasReacted = $reactionable->reactions()->where('chat_user_id', auth()->id())->exists();
    }

    public function react()
    {
        $existingReaction = $this->reactionable->reactions()->where('chat_user_id', auth()->id())->first();

        if ($existingReaction) {
            $existingReaction->delete();
            $this->hasReacted = false;
        } else {
            $this->reactionable->reactions()->create([
                'chat_user_id' => auth()->id(),
            ]);
            $this->hasReacted = true;
        }
        $this->reactionsCount = $this->reactionable->reactions()->count();
    }

    public function render()
    {
        return view('livewire.post-reactions');
    }
}
