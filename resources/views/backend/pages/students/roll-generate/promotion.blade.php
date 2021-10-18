@extends('backend.layouts.master')

@section('title')
    Student Promotion Form | Student Registration
@endsection

@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Upadte Student Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('student-registration.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back Student List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('promotion.store.student',$student->student_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <div class="form-row">
                              <div class="col-md-4">
                                <label for="name">Student Name </label>
                                <input type="text" name="name" class="form-control " id="name" value="{{ $student->student->name }}">
                              </div>
                              <div class="col-md-4">
                                <label for="father_name">Father Name </label>
                                <input type="text" name="father_name" class="form-control " id="father_name" value="{{ $student->student->father_name }}">
                              </div>
                              <div class="col-md-4">
                                <label for="mother_name">Mother Name </label>
                                <input type="text" name="mother_name" class="form-control " id="mother_name" value="{{ $student->student->mother_name }}" >
                              </div>
                              <div class="col-md-4">
                                <label for="mobile">Mobile Number </label>
                                <input type="text" name="mobile" class="form-control " id="mobile" value="{{ $student->student->mobile }}">
                              </div>
                              <div class="col-md-4">
                                <label for="address">Address </label>
                                <input type="text" name="address" class="form-control " id="address" value="{{ $student->student->address }}">
                              </div>
                              <div class="col-md-4">
                                <label for="gender">Gender <span class="text-danger font-weight-bold">*</span></label>
                                <select name="gender" id="gender" class="custom-select">
                                  <option value="">Select Gender</option>
                                  <option value="Male" {{ $student->student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                  <option value="Female" {{ $student->student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label for="religion">Religion <span class="text-danger font-weight-bold">*</span></label>
                                <select name="religion" id="religion" class="custom-select">
                                  <option value="">Select Religion</option>
                                  <option value="Muslim" {{ $student->student->religion == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                  <option value="Hindu" {{ $student->student->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                  <option value="Khristan" {{ $student->student->religion == 'Khristan' ? 'selected' : '' }}>Khristan</option>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label for="date">Date Of Birth </label>
                                <input class="date form-control" name="dob" type="text" autocomplete="off" value="{{ $student->student->dob }}">
                              </div>
                              <div class="col-md-4">
                                <label for="discount">Discount </label>
                                <input type="text" class="form-control" name="discount"  id="discount" value="{{ $student->discount->discount }}">
                              </div>
                              <div class="col-md-4">
                                <label for="class">Class <span class="text-danger font-weight-bold">*</span></label>
                                <select name="class_id" id="class" class="custom-select">
                                  <option value="">Select Class</option>
                                  @foreach ($classes as $cls)
                                      <option value="{{ $cls->id }}" {{ $student->class_id == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                              <div class="col-md-4">
                                <label for="group">Group</label>
                                <select name="group_id" id="group" class="custom-select">
                                  <option value="">Select Group</option>
                                  @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                              <div class="col-md-4">
                                <label for="year">Year <span class="text-danger font-weight-bold">*</span></label>
                                <select name="year_id" id="year" class="custom-select">
                                  <option value="">Select year</option>
                                  @foreach ($years as $year)
                                      <option value="{{ $year->id }}" {{ $student->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-4">
                                <label for="shift">Shift</label>
                                <select name="shift_id" id="shift" class="custom-select">
                                  <option value="">Select Shift</option>
                                  @foreach ($shifts as $shift)
                                      <option value="{{ $shift->id }}" {{ $student->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                             
                              <div class="col-md-4">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control " id="image">
                              </div>
                              <div class="col-md-4">
                                <img id="showImage" src="{{ asset('images/students/'.$student->student->image) }}" alt=""  width="120px" class="mt-2" style="border: 1px solid black; ">
                              </div>

                            </div>
                            
                            <button class="btn btn-success " type="submit">Promotion</button>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>

     @push('custom-scripts')
     <script type="text/javascript">
        $('.date').datepicker({  
          format: 'yyyy-mm-dd'
        }); 
        
        
     </script> 
     @endpush

@endsection