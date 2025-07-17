<?php

namespace App\Services;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioService
{
    
    private const MEDIA_CONFIG = [
        'image' => [
            'path' => 'portfolios/images',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
        'video' => [
            'path' => 'portfolios/videos',
            'types' => ['mp4', 'mov'],
            'max_size' => 104857600 // 100MB
        ],
        'file' => [
            'path' => 'portfolios/files',
            'types' => ['pdf', 'doc', 'docx'],
            'max_size' => 10485760 // 10MB
        ]
    ];

    public function __construct(
        private readonly FileService $fileService
    ) {}

    public function create(array $data): Portfolio
    {
        $portfolio = Portfolio::create($data);
        $this->handleMedia(request(), $portfolio);
        return $portfolio;
    }

    public function update(Portfolio $portfolio, array $data): Portfolio
    {
        // Delete old files
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if (request()->hasFile($field)) {
                $this->fileService->deleteFile($portfolio->$field, $config['path']);
            }
        } 

        $portfolio->update($data);
        $this->handleMedia(request(), $portfolio);

        return $portfolio;
    }

    public function delete(Portfolio $portfolio)
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($portfolio->$field) {
                $this->fileService->deleteFile($portfolio->$field, $config['path']);
            }
        }
        $portfolio->delete();
    }

    private function handleMedia(Request $request, Portfolio $portfolio): void
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($request->hasFile($field)) {
                $this->processFile($request->file($field), $portfolio, $field, $config);
            }
        }
    }

    private function processFile($file, Portfolio $portfolio, string $field, array $config): void
    {
        if (!$this->fileService->validateFile($file, $config['types'], $config['max_size'])) {
            return;
        }

        // Store only filename in database
        $portfolio->$field = $this->fileService->uploadFile($file, $config['path']);
        $portfolio->save();
    }

    public function getMediaPath(string $type): ?string
    {
        return self::MEDIA_CONFIG[$type]['path'] ?? null;
    }
}