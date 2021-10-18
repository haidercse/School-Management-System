@extends('backend.layouts.master')

@section('title')
    Student List | Student Registration
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Student  list</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('student-registration.create') }}" class="float-right btn btn-info"><i class="fas fa-plus-circle"> Student student</i></a>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('year.class.wise.search.student') }}" method="GET">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="class">Class</label>
                                    <select name="class_id" id="class" class="custom-select">
                                      <option value="">Select Class</option>
                                      @foreach ($classes as $cls)
                                          <option value="{{ $cls->id }}" {{  (@$cls_id == $cls->id) ? 'selected' : '' }} >{{ $cls->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="year">Year</label>
                                    <select name="year_id" id="year" class="custom-select">
                                      <option value="">Select year</option>
                                      @foreach ($years as $year)
                                          <option value="{{ $year->id }}" {{ (@$yr_id == $year->id) ? 'selected' : '' }}>{{ $year->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3" style="margin-top: 28px">
                                    <button class="btn btn-warning btn-sm" name="search" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (!@(search))
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Id</th>
                                    <th scope="col">Roll</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Year</th>
                                    @if (Auth::user()->role == 'Admin')
                                    <th scope="col">Code</th>
                                    @endif
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $student->student->name }}</td>
                                        <td>{{ $student->student->id_no }}</td>
                                        <td>{{ $student->roll  }}</td>
                                        <td>{{ $student->class->name }}</td>
                                        <td>{{ $student->year->name }}</td>
                                        @if (Auth::user()->role == 'Admin')
                                         <td>{{ $student->student->code }}</td>
                                        @endif
                                        <td>
                                            <img src="{{ asset('images/students/'.$student->student->image) }}" alt="{{ $student->student->name }}" width="82">
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('student-registration.edit',$student->student_id) }}"
                                                class="btn btn-success"><i class="far fa-edit"> Edit</i></a>
                                               
                                                <a href="{{ route('promotion.student',$student->student_id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-upload"> Promotion</i></a>
                                                    
                                            <a target="_blank" href="{{ route('student.pdf',$student->student_id) }}"
                                                        class="btn btn-warning btn-sm"><i class="far fa-file-pdf"> PDF</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Id</th>
                                    <th scope="col">Roll</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Year</th>
                                    @if (Auth::user()->role == 'Admin')
                                    <th scope="col">Code</th>
                                    @endif
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $student->student->name }}</td>
                                        <td>{{ $student->student->id_no }}</td>
                                        <td>{{ $student->roll  }}</td>
                                        <td>{{ $student->class->name }}</td>
                                        <td>{{ $student->year->name }}</td>
                                        @if (Auth::user()->role == 'Admin')
                                        <td>{{ $student->student->code }}</td>
                                        @endif
                                        <td>
                                            <img src="{{ asset('images/students/'.$student->student->image) }}" alt="{{ $student->student->name }}" width="82">
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('student-registration.edit',$student->student_id) }}"
                                                class="btn btn-success btn-sm"><i class="far fa-edit"> Edit</i></a>
                                               
                                            <a href="{{ route('promotion.student',$student->student_id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-upload"> Promotion</i></a>

                                            <a target="_blank" href="{{ route('student.pdf',$student->student_id) }}"
                                                        class="btn btn-warning btn-sm"><i class="far fa-file-pdf"> PDF</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
