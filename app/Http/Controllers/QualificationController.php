<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qualifications = Qualification::latest()->paginate(10);
        return view('admin.qualification.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.qualification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualificationRequest $request)
    {
        Qualification::create($request->validated());
        return to_route('admin.qualification')->with('message','New Qualification Added');
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
    public function edit(Qualification $qualification)
    {
        return view('admin.qualification.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQualificationRequest $request, Qualification $qualification)
    {
        $qualification->update($request->validated());
        if($request['type']== 'Education'){
            return to_route('admin.qualification.edu')->with('message','Education Updated');
        }else{
            return to_route('admin.qualification.exp')->with('message','Experience Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        $qualification -> delete();
        return back()->with('message', 'Qualification Deleted');
    }

    public function showEducation()
    {
        $educations = Qualification::where('type',['Education'])->orderBy('id')->get();
        return view('admin.qualification.edu',compact('educations'));
    }

    public function showExperience()
    {
        $experiences = Qualification::where('type',['Work'])->orderBy('id')->get();
        return view('admin.qualification.exp', compact('experiences'));
    }
}
