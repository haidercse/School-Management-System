
@extends('backend.layouts.master')

@section('title')
   Update Student-Group Form | Setup Management
@endsection

@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-10">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Update Group Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('student-group.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back Group List</i></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student-group.update',$group->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                              <div class="col-md-7 mb-3">
                                <label for="name">Group Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $group->name }}">
                              </div>
                              <div class="col-md-3 mb-3" style="margin-top: 28px">
                                <button class="btn btn-success" type="submit">Update!</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection