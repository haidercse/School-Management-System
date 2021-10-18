<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentSubject;

class StudentSubjectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = StudentSubject::orderBy('id','asc')->get();
        return view('backend.pages.setup.student-subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-subject.create');
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
            'name' => 'required|unique:student_subjects|max:50',
        ]);

        $subject = new StudentSubject();
        $subject->name = $request->name;
        $subject->save();
        return redirect()->route('student-subject.index')->with('success','subject  has been added successfully');
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
        $subject = StudentSubject::find($id);
        return view('backend.pages.setup.student-subject.edit',compact('subject'));
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

        $subject = StudentSubject::find($id);
        if (!is_null($request->name)) {
            $subject->name = $request->name;
        }else{
            return back()->with('error','Please, Input subject Name');
        }
        
        $subject->save();
        return redirect()->route('student-subject.index')->with('success','subject  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = StudentSubject::find($id);
        if (!is_null($subject)) {
            $subject->delete();
        }else{
            return redirect()->route('student-subject.index')->with('error','There is no subject name by this ID , SORRY');
        }

        return back()->with('success','Your subject has been deleted successfully');
    }
}
