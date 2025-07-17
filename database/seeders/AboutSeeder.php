<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate([
            'id' => 1
        ], [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '1234567890',

            'birth_date' => '1990-01-01',
            'avatar' => 'avatar.jpg',
            'city' => 'New York',
            'country' => 'USA',
            'address' => '123 Main St',

            'job' => 'Web Developer',
            'degree' => 'Masters',
            'experience' => '5 years',

            'title' => 'My Awesome Website',
            'description' => 'Your default description',
            //'image' => 'image.jpg',
            'header_image' => 'header_image.jpg',
            //'video' => 'video.mp4',
            'cv' => 'cv.pdf',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'linkedin' => 'https://linkedin.com',
            'instagram' => 'https://instagram.com',
            'github' => 'https://github.com',
            'youtube' => 'https://youtube.com',
            'website' => 'https://website.com',
            'email' => 'John_Doe@email.com',
            'user_id' => '1',
        ]);
    }
}
