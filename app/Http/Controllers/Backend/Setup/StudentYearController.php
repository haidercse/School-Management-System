<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = StudentYear::orderBy('id','desc')->get();
        return view('backend.pages.setup.student-year.index',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-year.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:student_years|max:50',
        ]);

        $year = new StudentYear();
        $year->name = $request->name;
        $year->save();
        return redirect()->route('student-year.index')->with('success','year  has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $year = StudentYear::find($id);
        return view('backend.pages.setup.student-year.edit',compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable| unique:student_years,name',
        ]);

        $year = StudentYear::find($id);
        if (!is_null($request->name)) {
            $year->name = $request->name;
        }else{
            return back()->with('error','Please, Input year Name');
        }
        
        $year->save();
        return redirect()->route('student-year.index')->with('success','year  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = StudentYear::find($id);
        if (!is_null($year)) {
            $year->delete();
        }else{
            return redirect()->route('student-year.index')->with('error','There is no year name by this ID , SORRY');
        }

        return back()->with('success','Your year has been deleted successfully');
    }
}
