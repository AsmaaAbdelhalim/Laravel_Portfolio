<?php

namespace App\Models;

use App\Mail\ContactMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'city',
        'subject',
        'message',
        ];
            // ...
    public static function boot() {
        parent::boot();
        static::created(function ($data) {
            $adminEmail = config('mail.admin');
            Mail::to($adminEmail)->send(new ContactMail($data));
        });
    }
}
