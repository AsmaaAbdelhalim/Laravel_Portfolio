<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUpdaters;
class Portfolio extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'url',
        'created_by',
        'updated_by',
    ];

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'updated_by' => 'array',
    ];
}
