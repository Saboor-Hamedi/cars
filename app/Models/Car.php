<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['user_id', 'name', 'color', 'year', 'description', 'image'];
    // protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class, table: 'votes')
            ->withPivot('vote')
            ->withTimestamps();
    }
    public function voteCount()
    {
        return $this->votes()->count();
    }
    public function updateVoteState(): bool
    {
        $user = Auth::user();

        return $user ? $user->votes()->where('car_id', $this->id)->exists() : false;
    }
}
