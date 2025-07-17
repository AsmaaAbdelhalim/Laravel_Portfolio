<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image', 
    //'image_name', 
    'project_id'];

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
