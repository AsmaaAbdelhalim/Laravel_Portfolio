<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUpdaters;
class About extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'first_name',
        'last_name',

        'phone',
        'birth_date',
        'age',
        'avatar',
        'city',
        'country',
        'address',

        'job',
        'degree',
        'experience',

        'title', 
        'description', 
        'image', 
        'header_image', 
        'video', 
        'cv', 
        'facebook', 
        'twitter', 
        'linkedin', 
        'instagram', 
        'github', 
        'youtube', 
        'website', 
        'email', 
        'social_links',
        'user_id', 
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'social_links' => 'array',
        'updated_by' => 'array',
    ];
}
