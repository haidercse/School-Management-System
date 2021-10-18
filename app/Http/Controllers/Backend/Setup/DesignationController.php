<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::orderBy('id','desc')->get();
        return view('backend.pages.setup.designation.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setup.designation.create');
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
            'name' => 'required|unique:designations|max:50',
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();
        return redirect()->route('designation.index')->with('success','designation  has been added successfully');
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
        $designation = Designation::find($id);
        return view('backend.pages.setup.designation.edit',compact('designation'));
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

        $designation = Designation::find($id);
        if (!is_null($request->name)) {
            $designation->name = $request->name;
        }else{
            return back()->with('error','Please, Input designation Name');
        }
        
        $designation->save();
        return redirect()->route('designation.index')->with('success','designation  has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $designation = Designation::find($id);
        // if (!is_null($designation)) {
        //     $designation->delete();
        // }else{
        //     return redirect()->route('designation.index')->with('error','There is no designation name by this ID , SORRY');
        // }

        // return back()->with('success','Your designation has been deleted successfully');
    }
}
