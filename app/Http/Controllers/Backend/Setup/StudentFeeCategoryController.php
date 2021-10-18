<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFeeCategory;

class StudentFeeCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = StudentFeeCategory::orderBy('id','desc')->get();
        return view('backend.pages.setup.student-fee.index',compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.student-fee.create');
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
            'name' => 'required|unique:student_fee_categories|max:50',
        ]);

        $fee = new StudentFeeCategory();
        $fee->name = $request->name;
        $fee->save();
        return redirect()->route('student-fee.index')->with('success','fee  has been added successfully');
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
        $fee = StudentFeeCategory::find($id);
        return view('backend.pages.setup.student-fee.edit',compact('fee'));
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

        $fee = StudentFeeCategory::find($id);
        if (!is_null($request->name)) {
            $fee->name = $request->name;
        }else{
            return back()->with('error','Please, Input fee Name');
        }
        
        $fee->save();
        return redirect()->route('student-fee.index')->with('success','fee  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee = StudentFeeCategory::find($id);
        if (!is_null($fee)) {
            $fee->delete();
        }else{
            return redirect()->route('student-fee.index')->with('error','There is no fee name by this ID , SORRY');
        }

        return back()->with('success','Your fee has been deleted successfully');
    }
}
