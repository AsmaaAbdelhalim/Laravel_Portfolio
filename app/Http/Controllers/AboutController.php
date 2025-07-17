<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Services\AboutService;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    private AboutService $aboutService;
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        try {
            $about = $this->aboutService->update(
                $about,
                $request->validated(),
            );
          //$request->validate([
             // 'header_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            //]);
            return redirect()
                ->route('admin.about.index', $about)
                ->with('message', 'About section updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update about');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //if delete from database delete images and files
        $about = About::findOrFail($id);
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        if ($about->cv) {
            Storage::disk('public/about')->delete($about->cv);
        }
        $about->delete();
        return redirect()
            ->route('admin.about.index')
            ->with('status', 'success');
    }
}
