<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectService
{
    
    private const MEDIA_CONFIG = [
        'image' => [
            'path' => 'projects/images',
            'types' => ['jpg', 'jpeg', 'png'],
            'max_size' => 5242880 // 5MB
        ],
        'video' => [
            'path' => 'projects/videos',
            'types' => ['mp4', 'mov'],
            'max_size' => 104857600 // 100MB
        ],
        'file' => [
            'path' => 'projects/files',
            'types' => ['pdf', 'doc', 'docx'],
            'max_size' => 10485760 // 10MB
        ]
    ];

    public function __construct(
        private readonly FileService $fileService
    ) {}

    public function create(array $data): Project
    {
        $project = Project::create($data);
        $this->handleMedia(request(), $project);

        // Handle image uploads
        if (isset($data['images'])) {
            foreach ($data['images'] as $imageFile) {
                $this->processImage($project, $imageFile);
            }
        }
        return $project;
    }

    public function update(Project $project, array $data): Project
    {
        // Delete old files
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if (request()->hasFile($field)) {
                $this->fileService->deleteFile($project->$field, $config['path']);
            }
        } 

        $project->update($data);
        $this->handleMedia(request(), $project);
        // 3. Handle deleted images (coming from hidden inputs)
    if (request()->has('deleted_images')) {
        foreach (request()->input('deleted_images') as $imageId) {
            $image = Image::find($imageId);
            if ($image) {
                $this->fileService->deleteFile($image->image, self::MEDIA_CONFIG['image']['path']);
                $image->delete();
            }
        }
    }

    // 4. Handle image replacements and new uploads
    if (request()->hasFile('images')) {
        foreach (request()->file('images') as $key => $file) {
            if (Str::startsWith($key, 'new_')) {
                // New image
                $this->processImage($project, $file);
            } else {
                // Replace existing image
                $image = Image::find($key);
                if ($image) {
                    $this->fileService->deleteFile($image->image, self::MEDIA_CONFIG['image']['path']);
                    $newPath = $this->fileService->uploadFile($file, self::MEDIA_CONFIG['image']['path']);
                    $image->update(['image' => $newPath]);
                }
            }
        }
    }

        return $project;
    }

    public function delete(Project $project)
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($project->$field) {
                $this->fileService->deleteFile($project->$field, $config['path']);
            }
        }
        $project->delete();
    }

    private function handleMedia(Request $request, Project $project): void
    {
        foreach (self::MEDIA_CONFIG as $field => $config) {
            if ($request->hasFile($field)) {
                $this->processFile($request->file($field), $project, $field, $config);
            }
        }
    }

    private function processFile($file, Project $project, string $field, array $config): void
    {
        if (!$this->fileService->validateFile($file, $config['types'], $config['max_size'])) {
            return;
        }

        // Store full path in database
        $project->$field = $this->fileService->uploadFile($file, $config['path']);
        $project->save();
    }

    private function processImage(Project $project, $file): void
    {
        if (!$this->validateFile($file)) {
            return;
        }

        // Upload the file and get the path
        $imagePath = $this->fileService->uploadFile($file, self::MEDIA_CONFIG['image']['path']);

        // Create and save the image record
        Image::create([
            'project_id' => $project->id,
            'image' => $imagePath,
            //'image_name' => $file->getClientOriginalName() // or any other logic to get the image name
        ]);
    }

    public function deleteImage(Image $image)
    {
        // Delete the image file
        $this->fileService->deleteFile($image->image, self::MEDIA_CONFIG['image']['path']);
        // Delete the image record
        $image->delete();
    }

    public function getMediaPath(string $type): ?string
    {
        return self::MEDIA_CONFIG[$type]['path'] ?? null;
    }

    public function validateFile($file): bool
    {
        $validator = Validator::make(['file' => $file], [
            'file' => 'required|file|mimes:' . implode(',', self::MEDIA_CONFIG['image']['types']) . '|max:' . (self::MEDIA_CONFIG['image']['max_size'] / 1024) // Convert bytes to kilobytes
        ]);

        return !$validator->fails();
    }
}