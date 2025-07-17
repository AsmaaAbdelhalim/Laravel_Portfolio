<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUpdaters;
class Project extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'url',
        'views',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'updated_by' => 'array',
    ];
}
