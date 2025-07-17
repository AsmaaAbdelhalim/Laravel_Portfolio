<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUpdaters;
class SkillLanguage extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'percent',
        'color',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'updated_by' => 'array',
    ];
}
