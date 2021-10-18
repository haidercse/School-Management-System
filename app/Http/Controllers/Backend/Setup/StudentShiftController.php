<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = StudentShift::orderBy('id','desc')->get();
        return view('backend.pages.setup.student-shift.index',compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-shift.create');
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
            'name' => 'required|unique:student_shifts|max:50',
        ]);

        $shift = new StudentShift();
        $shift->name = $request->name;
        $shift->save();
        return redirect()->route('student-shift.index')->with('success','shift  has been added successfully');
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
        $shift = StudentShift::find($id);
        return view('backend.pages.setup.student-shift.edit',compact('shift'));
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
            'name' => 'nullable',
        ]);

        $shift = StudentShift::find($id);
        if (!is_null($request->name)) {
            $shift->name = $request->name;
        }else{
            return back()->with('error','Please, Input shift Name');
        }
        
        $shift->save();
        return redirect()->route('student-shift.index')->with('success','shift  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = StudentShift::find($id);
        if (!is_null($shift)) {
            $shift->delete();
        }else{
            return redirect()->route('student-shift.index')->with('error','There is no shift name by this ID , SORRY');
        }

        return back()->with('success','Your shift has been deleted successfully');
    }
}
