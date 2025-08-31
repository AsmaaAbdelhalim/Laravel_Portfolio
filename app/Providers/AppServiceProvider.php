<?php

namespace App\Providers;

use App\Services\AboutService;
use Illuminate\Support\Facades\Log;
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
        // Use view composer to safely provide about data
        view()->composer('*', function ($view) {
            try {
                $aboutService = app(AboutService::class);
                $about = $aboutService->getAboutData();
                $pathabout = $aboutService->getPathAbout();
                
                $view->with('about', $about);
                $view->with('pathabout', $pathabout);
            } catch (\Exception $e) {
                // Log error and provide fallback values
                Log::warning('Failed to compose about data: ' . $e->getMessage());
                
                $view->with('about', null);
                $view->with('pathabout', [
                    'avatar' => 'abouts/avatars',
                    'image' => 'abouts/images',
                    'header_image' => 'abouts/header_images',
                    'video' => 'abouts/videos',
                    'cv' => 'abouts/cvs',
                ]);
            }
        });
    }
}
