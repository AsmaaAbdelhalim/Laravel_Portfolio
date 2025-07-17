<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\SkillLanguage;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::count();
        $categories = Category::count();
        $projects = Project::count();
        $services = Service::count();
        $skills = SkillLanguage::count();
        $contacts = Contact::count();
        $users = User::count();
        
        $experiences = Qualification::where('type', ['Work'])->count();
        $educations = Qualification::where('type', ['Education'])->count();

        return view('admin.index', compact('portfolios', 'categories', 'projects', 'services', 'skills', 'contacts', 'users'
        ,'experiences','educations'
    ));
        
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
