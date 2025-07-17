<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    
    private const MEDIA_CONFIG = [
        'image' => [
            'path' => 'categories/images',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
        'video' => [
            'path' => 'categories/videos',
            'types' => ['mp4', 'mov'],
            'max_size' => 104857600 // 100MB
        ],
        'file' => [
            'path' => 'categories/files',
            'types' => ['pdf', 'doc', 'docx'],
            'max_size' => 10485760 // 10MB
        ]
    ];

    public function __construct(
        private readonly FileService $fileService
    ) {}

    public function create(array $data): Category
    {
        $category = Category::create($data);
        $this->handleMedia(request(), $category);
        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        // Delete old files
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if (request()->hasFile($field)) {
                $this->fileService->deleteFile($category->$field, $config['path']);
            }
        } 

        $category->update($data);
        $this->handleMedia(request(), $category);

        return $category;
    }

    public function delete(Category $category)
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($category->$field) {
                $this->fileService->deleteFile($category->$field, $config['path']);
            }
        }
        $category->delete();
    }

    private function handleMedia(Request $request, Category $category): void
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($request->hasFile($field)) {
                $this->processFile($request->file($field), $category, $field, $config);
            }
        }
    }

    private function processFile($file, Category $category, string $field, array $config): void
    {
        if (!$this->fileService->validateFile($file, $config['types'], $config['max_size'])) {
            return;
        }
        
        // Store full path in database
        $category->$field = $this->fileService->uploadFile($file, $config['path']);
        $category->save();
    }

    public function getMediaPath(string $type): ?string
    {
        return self::MEDIA_CONFIG[$type]['path'] ?? null;
    }
}