<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFeeCategory;
use App\Models\StudentClass;
use App\Models\StudentAssignSubject;
use App\Models\StudentSubject;

class StudentAssignSubjectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignSubjects = StudentAssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.pages.setup.student-assign-subject.index',compact('assignSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $subjects = StudentSubject::all();
        $classes = StudentClass::all();
        return view('backend.pages.setup.student-assign-subject.create',compact('subjects','classes'));
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
            "class_id"  => 'required',
            "subject_id.*" => 'required',
            "full_mark.*" => 'required',
            "pass_mark.*" => 'required',
            "get_mark.*" => 'required',
        ]);
        
        $countSubject = count($request->subject_id);
        if ($countSubject != NULL) {
            for ($i=0; $i < $countSubject; $i++) { 
                $assignSubject = new StudentAssignSubject();
                $assignSubject->class_id = $request->class_id ;
                $assignSubject->subject_id = $request->subject_id[$i] ;
                $assignSubject->full_mark = $request->full_mark[$i] ;
                $assignSubject->pass_mark = $request->pass_mark[$i] ;
                $assignSubject->get_mark = $request->get_mark[$i] ;
                $assignSubject->save();
                
            }
           
            return redirect()->route('student-assign-subject.index')->with('success','assignSubject  has been added successfully');
        }else{
            return redirect()->route('student-assign-subject.create')->with('error','Sorry, You do not Select  any class ');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($class_id)
    {
        $assignSubjects = StudentAssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        return view('backend.pages.setup.student-assign-subject.details',compact('assignSubjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $subjects = StudentSubject::all();
        $classes = StudentClass::all();
        $assignSubjects = StudentAssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        return view('backend.pages.setup.student-assign-subject.edit',compact('assignSubjects','subjects','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {
        $request->validate([
            "class_id"  => 'required',
            "subject_id.*" => 'nullable',
            "full_mark.*" => 'nullable',
            "pass_mark.*" => 'nullable',
            "get_mark.*" => 'nullable',
        ]);
        $countSubject = count($request->subject_id);
        
        if ($request->subject_id == NULL) {
           return back()->with('error','There is no Subject! please input any class and also assignSubject!');
        }else{
            StudentAssignSubject::where('class_id',$class_id)->delete();
            for ($i=0; $i < $countSubject; $i++) { 
                $assignSubject = new StudentAssignSubject();
                $assignSubject->class_id = $request->class_id ;
                $assignSubject->subject_id = $request->subject_id[$i] ;
                $assignSubject->full_mark = $request->full_mark[$i] ;
                $assignSubject->pass_mark = $request->pass_mark[$i] ;
                $assignSubject->get_mark = $request->get_mark[$i] ;
                $assignSubject->save();
                
            }
        
            return redirect()->route('student-assign-subject.index')->with('success','assignSubject  has been updated successfully');
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //     $assignSubject = StudentAssignSubject::find($id);
    //     if (!is_null($assignSubject)) {
    //         $assignSubject->delete();
    //     }else{
    //         return redirect()->route('student-assign-subject.index')->with('error','There is no assignSubject name by this ID , SORRY');
    //     }

    //     return back()->with('success','Your assignSubject has been deleted successfully');
     }
}
