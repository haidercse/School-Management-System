<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentExamType;

class StudentExamTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = StudentExamType::orderBy('id','desc')->get();
        return view('backend.pages.setup.student-exam.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-exam.create');
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
            'name' => 'required|unique:student_exam_types|max:50',
        ]);

        $exam = new StudentExamType();
        $exam->name = $request->name;
        $exam->save();
        return redirect()->route('student-exam.index')->with('success','exam  has been added successfully');
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
        $exam = StudentExamType::find($id);
        return view('backend.pages.setup.student-exam.edit',compact('exam'));
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

        $exam = StudentExamType::find($id);
        if (!is_null($request->name)) {
            $exam->name = $request->name;
        }else{
            return back()->with('error','Please, Input exam type Name');
        }
        
        $exam->save();
        return redirect()->route('student-exam.index')->with('success','exam  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = StudentExamType::find($id);
        if (!is_null($exam)) {
            $exam->delete();
        }else{
            return redirect()->route('student-exam.index')->with('error','There is no exam name by this ID , SORRY');
        }

        return back()->with('success','Your exam has been deleted successfully');
    }
}
