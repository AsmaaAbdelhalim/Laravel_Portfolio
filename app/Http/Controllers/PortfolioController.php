<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    private PortfolioService $portfolioService;
    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        $path = $this->portfolioService->getMediaPath('image');
        // or
        //mageUrl = asset('storage/' . $path . '/' . $portfolio->image);
        //$categories = Category::with('projects')->get();
        //$portfolios = Portfolio::with('category')->with('projects')->get();
        return view('admin.portfolio.index', compact('portfolios', 'path'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        try {
            $portfolio = $this->portfolioService->create(
                $request->validated()
            );

            return redirect()
                ->route('admin.portfolio.index', $portfolio)
                ->with('success', 'Portfolio created successfully');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create portfolio');
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
    public function edit(Portfolio $portfolio)
    {
        $path = $this->portfolioService->getMediaPath('image');
        return view('admin.portfolio.edit', compact('portfolio', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        try {
            $portfolio = $this->portfolioService->update(
                $portfolio,
                $request->validated()
            );

            return redirect()
                ->route('admin.portfolio.index', $portfolio)
                ->with('success', 'Portfolio updated successfully');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update portfolio');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        try{
            $this->portfolioService->delete($portfolio);
            $portfolio->delete();
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to delete portfolio');
        }
    }
}
