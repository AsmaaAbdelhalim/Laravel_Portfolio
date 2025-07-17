<?php

namespace App\Services;

use App\Models\About;
use Illuminate\Http\Request;

class AboutService
{
    
    private const MEDIA_CONFIG = [
        'avatar' => [
            'path' => 'abouts/avatars',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
    
        'image' => [
            'path' => 'abouts/images',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
        'header_image' => [
            'path' => 'abouts/header_images',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
        'video' => [
            'path' => 'abouts/videos',
            'types' => ['mp4', 'mov'],
            'max_size' => 104857600 // 100MB
        ],
        'cv' => [
            'path' => 'abouts/cvs',
            'types' => ['pdf', 'doc', 'docx'],
            'max_size' => 10485760 // 10MB
        ]
    ];

    public function __construct(
        private readonly FileService $fileService
    ) {}

    public function create(array $data): About
    {
        $about = About::create($data);
        $this->handleMedia(request(), $about);
        return $about;
    }

    public function update(About $about, array $data): About
    {
        // Delete old files
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if (request()->hasFile($field)) {
                $this->fileService->deleteFile($about->$field, $config['path']);
            }
        } 
        $about->update($data);

        $this->handleMedia(request(), $about);
        return $about;
    }

    public function delete(About $about)
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($about->$field) {
                $this->fileService->deleteFile($about->$field, $config['path']);
            }
        }
        $about->delete();
    }

    private function handleMedia(Request $request, About $about): void
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($request->hasFile($field)) {
                $this->processFile($request->file($field), $about, $field, $config);
            }
        }
    }

    private function processFile($file, About $about, string $field, array $config): void
    {
        if (!$this->fileService->validateFile($file, $config['types'], $config['max_size'])) {
            return;
        }

        // Store full path in database
        $about->$field = $this->fileService->uploadFile($file, $config['path']);
        $about->save();
    }

    public function getMediaPath(string $type): ?string
    {
        return self::MEDIA_CONFIG[$type]['path'] ?? null;
    }
}