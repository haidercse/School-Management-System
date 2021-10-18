<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;


class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = StudentClass::orderBy('id','asc')->get();
        return view('backend.pages.setup.student-class.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-class.create');
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
            'name' => 'required|unique:student_classes|max:50',
        ]);

        $class = new StudentClass();
        $class->name = $request->name;
        $class->save();
        return redirect()->route('student-class.index')->with('success','Class name has been added successfully');
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
        $class = StudentClass::find($id);
        return view('backend.pages.setup.student-class.edit',compact('class'));
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

        $class = StudentClass::find($id);
        if (!is_null($request->name)) {
            $class->name = $request->name;
        }else{
            return back()->with('error','Please, Input class Name');
        }
        
        $class->save();
        return redirect()->route('student-class.index')->with('success','Class name has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = StudentClass::find($id);
        if (!is_null($class)) {
            $class->delete();
        }else{
            return redirect()->route('student-class.index')->with('error','There is no class name by this ID , SORRY');
        }

        return back()->with('success','Your class has been deleted successfully');
    }
}
