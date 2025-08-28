<?php

namespace App\Providers;

use App\Models\About;
use App\Services\AboutService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $aboutService = App(AboutService::class);
        $about = About::first();
        $pathabout = [
            'avatar' => $aboutService->getMediaPath('avatar'),
            'image' => $aboutService->getMediaPath('image'),
            'header_image' => $aboutService->getMediaPath('header_image'),
            'video' => $aboutService->getMediaPath('video'),
            'cv' => $aboutService->getMediaPath('cv'),
        ];
        view()->share('about', $about);
        view()->share('pathabout', $pathabout);
    }
}
