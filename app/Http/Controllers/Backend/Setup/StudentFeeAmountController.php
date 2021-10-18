<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFeeCategory;
use App\Models\StudentClass;
use App\Models\StudentFeeAmount;

class StudentFeeAmountController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amounts = StudentFeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.pages.setup.student-fee-amount.index',compact('amounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $FeeCategories = StudentFeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.pages.setup.student-fee-amount.create',compact('FeeCategories','classes'));
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
            "amount.*" => 'required|max:50',
            "class_id.*"  => 'required',
            "fee_category_id" => 'required',
        ]);
        
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new StudentFeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id ;
                $fee_amount->class_id = $request->class_id[$i] ;
                $fee_amount->amount = $request->amount[$i] ;
                $fee_amount->save();
                
            }
           
            return redirect()->route('student-fee-amount.index')->with('success','amount  has been added successfully');
        }else{
            return redirect()->route('student-fee-amount.create')->with('error','Sorry, You do not Select  any class ');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fee_category_id)
    {
        $amounts = StudentFeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.pages.setup.student-fee-amount.details',compact('amounts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_category_id)
    {
        $FeeCategories = StudentFeeCategory::all();
        $classes = StudentClass::all();
        $amounts = StudentFeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.pages.setup.student-fee-amount.edit',compact('amounts','FeeCategories','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_category_id)
    {
        $request->validate([
            "amount.*" => 'required|max:50',
            "class_id.*"  => 'required',
            "fee_category_id" => 'nullable',
        ]);
        $countClass = count($request->class_id);
        
        if ($request->class_id == NULL) {
           return back()->with('error','There is no class! please input any class and also amount!');
        }else{
            StudentFeeAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new StudentFeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id ;
                $fee_amount->class_id = $request->class_id[$i] ;
                $fee_amount->amount = $request->amount[$i] ;
                $fee_amount->save();
                
            }
        
            return redirect()->route('student-fee-amount.index')->with('success','amount  has been updated successfully');
            
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
    //     $amount = StudentFeeAmount::find($id);
    //     if (!is_null($amount)) {
    //         $amount->delete();
    //     }else{
    //         return redirect()->route('student-fee-amount.index')->with('error','There is no amount name by this ID , SORRY');
    //     }

    //     return back()->with('success','Your amount has been deleted successfully');
     }
}
