<?php

namespace App\Models;

use App\Traits\HasUpdaters;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
        'portfolio_id',
        'created_by',
        'updated_by',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'updated_by' => 'array',
    ];



}
