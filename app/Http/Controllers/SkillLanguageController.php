<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillLanguageRequest;
use App\Http\Requests\UpdateSkillLanguageRequest;
use App\Models\SkillLanguage;
use Illuminate\Http\Request;

class SkillLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skillLanguages = SkillLanguage::latest()->paginate(10);
        return view('admin.skillLanguage.index', compact('skillLanguages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skillLanguage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillLanguageRequest $request)
    {
        SkillLanguage::create($request->validated());
        return to_route('admin.skillLanguage.index')->with('message', 'New skill/language added');
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
    public function edit(SkillLanguage $skillLanguage)
    {
        $skill_language = $skillLanguage;
        return view('admin.skillLanguage.edit', compact('skillLanguage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillLanguageRequest $request, SkillLanguage $skillLanguage)
    {
        $skillLanguage->update($request->validated());
        return to_route('admin.skillLanguage.index')->with('message', 'Skill/Language Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkillLanguage $skillLanguage)
    {
        $skillLanguage->delete();
        return back()->with('message', 'Skill/Language Deleted');
    }

    public function showSkill()
    {
        $skills = SkillLanguage::where('type',['Skill'])->orderBy('id')->get();
        return view('admin.skillLanguage.skill',compact('skills'));
    }

    public function showLanguage()
    {
        $languages = SkillLanguage::where('type',['Language'])->orderBy('id')->get();
        return view('admin.skillLanguage.language', compact('languages'));
    }
}
