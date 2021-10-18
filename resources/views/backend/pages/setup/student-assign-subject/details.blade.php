@extends('backend.layouts.master')

@section('title')
   Details Student-Assign-Subject | Setup Management
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Student Assign Subject Details</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('student-assign-subject.index') }}" class="float-right btn btn-info"><i class="fas fa-list"> fee assignSubject List</i></a>
                    </div>
                    <div class="card-body">
                       <div class="card-header mb-3 text-center">
                         <h3>Class - {{ $assignSubjects[0]->Class->name }}</h3> 
                       </div>
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Full Mark</th>
                                    <th scope="col">Pass Mark</th>
                                    <th scope="col">Subjective Mark</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignSubjects as $assignSubject)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $assignSubject->Subject->name }}</td>
                                        <td>{{ $assignSubject->full_mark }}</td>
                                        <td>{{ $assignSubject->pass_mark }}</td>
                                        <td>{{ $assignSubject->get_mark }}</td> 
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
