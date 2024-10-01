<?php

namespace App\Livewire\Vote;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Vote extends Component
{
    public Car $car;
    public $count;
    public $hasVote;

    public function mount()
    {
        $this->updateVoteState();
    }
    public function toggleVote(int $voteValue)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please log in to vote.');
            $this->dispatch('voteMessage');
            return;

        }

        $user = auth()->user();
        // Check if the user has already voted for this car
        $hasVote = $user->votes()->where('car_id', $this->car->id)->exists();

        if ($hasVote) {
            $user->votes()->detach($this->car->id);
        } else {
            // Attach with vote value
            $user->votes()->attach($this->car->id, attributes: ['vote' => $voteValue]);
        }
        $this->updateVoteState(); // update vote state after toggle

    }
    protected function updateVoteState(): void
    {
        $this->hasVote = $this->car->updateVoteState();
        $this->count = $this->car->votes()->count();
    }

    public function render()
    {
        return view('livewire.vote.vote', [
            'count' => $this->count,
            'hasVote' => $this->hasVote,
        ]);

    }
}
