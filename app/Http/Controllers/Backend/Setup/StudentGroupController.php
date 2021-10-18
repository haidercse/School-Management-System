<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = StudentGroup::orderBy('id','desc')->get();
        return view('backend.pages.setup.student-group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-group.create');
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
            'name' => 'required|unique:student_groups|max:50',
        ]);

        $group = new StudentGroup();
        $group->name = $request->name;
        $group->save();
        return redirect()->route('student-group.index')->with('success','group  has been added successfully');
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
        $group = StudentGroup::find($id);
        return view('backend.pages.setup.student-group.edit',compact('group'));
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

        $group = StudentGroup::find($id);
        if (!is_null($request->name)) {
            $group->name = $request->name;
        }else{
            return back()->with('error','Please, Input group Name');
        }
        
        $group->save();
        return redirect()->route('student-group.index')->with('success','group  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = StudentGroup::find($id);
        if (!is_null($group)) {
            $group->delete();
        }else{
            return redirect()->route('student-group.index')->with('error','There is no group name by this ID , SORRY');
        }

        return back()->with('success','Your group has been deleted successfully');
    }
}
