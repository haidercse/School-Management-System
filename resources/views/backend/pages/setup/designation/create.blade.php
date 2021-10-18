@extends('backend.layouts.master')

@section('title')
    Designation Form | Setup Management
@endsection

@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-10">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Add Designation Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('designation.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back Designation List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('designation.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                              <div class="col-md-7 mb-3">
                                <label for="name">Designation Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                              </div>
                              <div class="col-md-3 mb-3" style="margin-top: 28px">
                                <button class="btn btn-primary" type="submit">Submit</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection