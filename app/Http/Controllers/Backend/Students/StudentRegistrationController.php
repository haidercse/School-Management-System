<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use File;
use Barryvdh\DomPDF\Facade as PDF;

class StudentRegistrationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = StudentYear::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        $yr_id = StudentYear::orderBy('id','desc')->first()->id;
        $cls_id = StudentClass::orderBy('id','asc')->first()->id;
        $students = AssignStudent::where('year_id',$yr_id)->where('class_id',$cls_id)->get();
        return view('backend.pages.students.registration.index',compact('students','years','classes','yr_id','cls_id'));
    }
    /**
     * show searched student
     * year and class wise find student
     * this is the get method
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function searchedStudent(Request $request){
        $request->validate([
            'year_id' => 'required',
            'class_id' => 'required',
        ]);

        $years = StudentYear::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        $yr_id = $request->year_id;
        $cls_id = $request->class_id;
        $students = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return view('backend.pages.students.registration.index',compact('students','years','classes','yr_id','cls_id'));
     }

    /**
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup ::all();
        $shifts = StudentShift::all();
        return view('backend.pages.students.registration.create',compact('years','classes','groups','shifts'));
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
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'mobile' => 'required|max:12',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'required',
        ]);

        $checkYear = StudentYear::find($request->year_id)->name;
        $student = User::where('user_type','student')->orderBy('id','desc')->first();
        if ($student == NULL) {
            $firstReg = 0;
            $studentId = $firstReg + 1;
            if ($studentId < 10) {
               $id_no = '000'.$studentId;
            }
            elseif ($studentId < 100) {
                $id_no = '00'.$studentId;
            }
            elseif ($studentId < 1000) {
                $id_no = '0'.$studentId;
            }
        }else{
            $student = User::where('user_type','student')->orderBy('id','desc')->first()->id;
            $studentId = $student + 1;
            if ($studentId < 10) {
                $id_no = '000'.$studentId;
             }
             elseif ($studentId < 100) {
                 $id_no = '00'.$studentId;
             }
             elseif ($studentId < 1000) {
                 $id_no = '0'.$studentId;
             }
        }
        $final_id_no = $checkYear.$id_no; 
        $user = new User();
        $code = rand(0000,9999);
        $user->id_no = $final_id_no;
        $user->password = Hash::make($code);
        $user->code = $code;
        $user->user_type = 'student';
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d',strtotime($request->dob));
      

            //image save in database
           if($request->has('image')){
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/students');
            $image->move($dest,$reImage);

            // save in database
            $user->image = $reImage;
           
        }
        $user->save();

        //assign student table 
        $assignStudents = new AssignStudent();
        $assignStudents->student_id = $user->id;
        $assignStudents->class_id = $request->class_id;
        $assignStudents->year_id = $request->year_id;
        $assignStudents->group_id = $request->group_id;
        $assignStudents->shift_id = $request->shift_id;
        $assignStudents->save();
        
        //discount students table
        $discountStudents = new DiscountStudent();
        $discountStudents->assign_student_id = $assignStudents->id;
        $discountStudents->fee_category_id = 1;
        $discountStudents->discount = $request->discount;
        $discountStudents->save();

        return redirect()->route('student-registration.index')->with('success','student  has been added successfully');
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
    public function edit($student_id)
    {
        $student = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        //dd($student->toArray());
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup ::all();
        $shifts = StudentShift::all();
        return view('backend.pages.students.registration.edit',compact('student','years','classes','groups','shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id)
    {
        $request->validate([
            'name' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'mobile' => 'nullable|max:12',
            'address' => 'nullable',
            'gender' => 'nullable',
            'religion' => 'nullable',
            'dob' => 'nullable',
            'discount' => 'nullable',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'nullable',
        ]);

        $user = User::where('id',$student_id)->first();
        //dd($user->toArray());
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d',strtotime($request->dob));
      
            //update image
            if($request->has('image')){
                //deleted Old Images
                if(File::exists('images/students/'.$user->image)){
                    File::delete('images/students/'.$user->image);
                }
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('images/students/');
            $image->move($dest,$reImage);

            // save in database
            $user->image = $reImage;

        }
        $user->save();

        //assign student table 
        $assignStudents = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
        $assignStudents->class_id = $request->class_id;
        $assignStudents->year_id = $request->year_id;
        $assignStudents->group_id = $request->group_id;
        $assignStudents->shift_id = $request->shift_id;
        $assignStudents->save();
        
        //discount students table
        $discountStudents = DiscountStudent::where('assign_student_id',$request->id)->first();
        $discountStudents->discount = $request->discount;
        $discountStudents->save();

        return redirect()->route('student-registration.index')->with('success','student  has been updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     * promotion student
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promotionStudent($student_id)
    {
        $student = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        //dd($student->toArray());
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup ::all();
        $shifts = StudentShift::all();
        return view('backend.pages.students.registration.promotion',compact('student','years','classes','groups','shifts'));
    }
    /**
     * Show the form for editing the specified resource.
     * promotion student
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promotionStoreStudent(Request $request, $student_id)
    {
        $request->validate([
            'name' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'mobile' => 'nullable|max:12',
            'address' => 'nullable',
            'gender' => 'nullable',
            'religion' => 'nullable',
            'dob' => 'nullable',
            'discount' => 'nullable',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'nullable',
        ]);

        $user = User::where('id',$student_id)->first();
        //dd($user->toArray());
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d',strtotime($request->dob));
      
            //update image
            if($request->has('image')){
                //deleted Old Images
                if(File::exists('images/students/'.$user->image)){
                    File::delete('images/students/'.$user->image);
                }
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('images/students/');
            $image->move($dest,$reImage);

            // save in database
            $user->image = $reImage;

        }
        $user->save();

        //assign student table 
        $assignStudents = new AssignStudent();
        $assignStudents->student_id = $student_id;
        $assignStudents->class_id = $request->class_id;
        $assignStudents->year_id = $request->year_id;
        $assignStudents->group_id = $request->group_id;
        $assignStudents->shift_id = $request->shift_id;
        $assignStudents->save();
        
        //discount students table
        $discountStudents = new DiscountStudent();
        $discountStudents->assign_student_id = $assignStudents->id;
        $discountStudents->fee_category_id = 1;
        $discountStudents->discount = $request->discount;
        $discountStudents->save();

        return redirect()->route('student-registration.index')->with('success','student  has been promoted successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     * all student's information 
     * generate pdf invoice 
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentPdfFile($student_id)
    {
        $student = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        // return view('backend.pages.students.registration.pdf',compact('student'));
       $pdf = PDF::loadView('backend.pages.students.registration.pdf',compact('student'));
       return $pdf->download('student-details.pdf');
       
    }
}
