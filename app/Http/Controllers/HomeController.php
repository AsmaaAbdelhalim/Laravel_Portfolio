<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\SkillLanguage;
use App\Services\AboutService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private ProjectService $projectService;
    private AboutService $aboutService;
    public function __construct(ProjectService $projectService, AboutService $aboutService)
    {
        $this->projectService = $projectService;
        $this->aboutService = $aboutService;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $about = About::first();
        $experiences = Qualification::where('type', 'Work')->orderBy('id', 'desc')->take(3)->get();
        $educations = Qualification::where('type', 'Education')->orderBy('id', 'desc')->take(3)->get();
        $skills = SkillLanguage::where('type', 'skill')->orderBy('id', 'desc')->get();
        $languages = SkillLanguage::where('type', 'language')->orderBy('id', 'desc')->get();
        $services = Service::take(9)->get();

        $portfolios = Portfolio::with(['categories.projects.category'])->get();

        // Manually paginate "All" projects per portfolio
        foreach ($portfolios as $portfolio) {
        $allProjects = $portfolio->categories->flatMap->projects;

        $paginatedProjects = new \Illuminate\Pagination\LengthAwarePaginator(
            $allProjects->forPage(1, 6), // Change "6" to your preferred per-page limit
            $allProjects->count(),
            6,
            1,
            ['path' => request()->url(), 'pageName' => 'page_' . $portfolio->id]
        );

        $portfolio->paginatedProjects = $paginatedProjects;
    }

    // Count views for all projects on home page load
    //$allProjects = Project::all();
    
    // Get the session array for viewed projects
    //$viewedProjects = session()->get('viewed_home_projects', []); 
    
    // Optional: limit size to avoid memory bloat
    //$viewedProjects = array_slice($viewedProjects, -100); 
    
    //foreach ($allProjects as $project) { 
    //    if (!in_array($project->id, $viewedProjects)) { 
    //        $project->increment('views'); 
    //        $viewedProjects[] = $project->id; 
    //    }
    //}
    
    // Save updated list back to session
    //session(['viewed_home_projects' => $viewedProjects]);

    $path = app(\App\Services\ProjectService::class)->getMediaPath('image');
    $pathabout = [
        'image' => $this->aboutService->getMediaPath('image'),
        'cv' => $this->aboutService->getMediaPath('cv'),
        'video' => $this->aboutService->getMediaPath('video'),
        'avatar' => $this->aboutService->getMediaPath('avatar'),
        'header_image' => $this->aboutService->getMediaPath('header_image'),
    ];

    return view('home', compact(
        'about',
        'experiences',
        'educations',
        'skills',
        'languages',
        'services',
        'portfolios',
        'path',
        'pathabout'
    ));
    }

    public function filterProjects(Request $request)
{
    $categoryId = $request->category_id;
    $portfolioId = $request->input('portfolio_id');

    $projectsQuery = Project::whereHas('category', function ($query) use ($portfolioId) {
        $query->whereHas('portfolio', function ($q) use ($portfolioId) {
            $q->where('id', $portfolioId);
        });
    });

    if ($categoryId && $categoryId != 0) {
        $projectsQuery->where('category_id', $categoryId);
    }

    $projects = $projectsQuery->latest()->paginate(6); // match this to what you used in the index

    $path = app(\App\Services\ProjectService::class)->getMediaPath('image');

    return view('partials.projects', compact('projects', 'path'))->render();
}

}
