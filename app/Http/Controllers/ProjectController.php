<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        $path = $this->projectService->getMediaPath('image');

        return view('admin.project.index', compact('projects', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.project.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            DB::beginTransaction();
            
            // Create the project and handle images
            $project = $this->projectService->create($request->validated());

            DB::commit();

            return redirect()
                ->route('admin.project.index')
                ->with('success', 'Project created successfully', $project);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Project creation failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to create project. Please try again.');
        }

        if ($request->fails()) {
            Log::error('Validation failed', $request->errors()->toArray());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $path = $this->projectService->getMediaPath('image');
        return view('admin.project.edit', compact('project', 'categories', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        try {
            $project = $this->projectService->update(
                $project,
                $request->validated(),
            );

            return redirect()
                ->route('admin.project.index', $project)
                ->with('success', 'Project updated successfully');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update project');
               
        }
         Log::error('Project update failed: ' . $e->getMessage());
/////////////////////////////////////

          //  DB::beginTransaction();          
          //  DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try{ 
         foreach ($project->images as $image) {
            $this->projectService->deleteImage($image);
        }
            $this->projectService->delete($project);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to delete project');
        }
        return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully!');
    }
}
