<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUpdaters;
class Service extends Model
{
    use HasUpdaters;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'icon',
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
