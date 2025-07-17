<?php

namespace App\Traits;

use App\Models\User;

trait HasUpdaters
{
    public function getUpdatersAttribute()
{
    $entries = collect($this->updated_by ?? []);

    $users = User::whereIn('id', $entries->pluck('id'))->get()->keyBy('id');
    
    return $entries->map(function ($entry) use ($users) {
        return [
            'user' => $users->get($entry['id']),
            'updated_at' => $entry['updated_at'] ?? null,
        ];
    })->filter(fn($entry) => $entry['user']);
}

}
