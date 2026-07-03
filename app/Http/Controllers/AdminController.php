<?php

namespace App\Http\Controllers;
use App\Models\StrandCourse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $sections = StrandCourse::all();
        return view('AdminSide.sections', compact('sections'));
    }

    public function sections()
    {
        $sections = StrandCourse::all();
        return view('AdminSide.sections', compact('sections'));
    }
     // ✅ SAVE TO DATABASE
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'idstrandcourse' => 'required',
            'strandcourse' => 'required|string|max:100',
            'max_section' => 'required|integer',
            'shs_college' => 'required|integer'
        ]);

        // insert data
        StrandCourse::create([
            'idstrandcourse' => $request->idstrandcourse,
            'strandcourse'   => $request->strandcourse,
            'max_section'    => $request->max_section,
            'shs_college'    => $request->shs_college,
        ]);

        // redirect back with message
        return redirect()
            ->route('sections.index')
            ->with('success', 'Section added successfully!');
    }
}

