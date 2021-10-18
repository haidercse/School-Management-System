@extends('backend.layouts.master')

@section('title')
   Update User Form | User Managemnent
@endsection

@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Add user Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('user.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back user List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('user.update',$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                              <div class="col-md-4">
                                <label for="role">User Role</label>
                                <select name="role" id="role" class="custom-select">
                                  <option value="">Select Role</option>
                                  <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                  <option value="Opertaor" {{ $user->role == 'Opertaor' ? 'selected' : '' }}>Operator</option>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label for="name"> Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                              </div>
                              <div class="col-md-4">
                                <label for="email"> Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
                              </div>
                              
                            </div>
                            <button class="btn btn-success" type="submit">Update!</button>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection