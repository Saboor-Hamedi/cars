<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lastname', 'birthday', 'photo'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // check if profile is updated
    public function isModified(array $data)
    {
        foreach ($data as $key => $value) {
            if ($this->{$key} != $value) {
                return true;
            }
        }
        return false;
    }
}
