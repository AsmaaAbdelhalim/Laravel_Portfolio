<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Portfolio;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        $path = $this->categoryService->getMediaPath('image');

        return view('admin.category.index', compact('categories', 'path'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $portfolios = Portfolio::all();
        return view('admin.category.create', compact('portfolios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create(
                $request->validated()
            );

            return redirect()
                ->route('admin.category.index', $category)
                ->with('success', 'Category created successfully');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create category');
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
    public function edit(Category $category)
    {
        $portfolios = Portfolio::all();
        $path = $this->categoryService->getMediaPath('image');
        return view('admin.category.edit', compact('category', 'portfolios', 'path'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->update(
                $category,
                $request->validated()
            );

            return redirect()
                ->route('admin.category.index', $category)
                ->with('success', 'Category updated successfully');
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            $this->categoryService->delete($category);
            $category->delete();
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to delete category');
        }
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully!');

    }
}
