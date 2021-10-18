@extends('backend.layouts.master')

@section('title')
  Update  Student-Assign-Subject Form | Setup Management
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Update Assign Subject Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('student-assign-subject.index') }}" class=" btn btn-warning"><i
                                class="fas fa-long-arrow-alt-right"> Back Assign Subject List</i></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student-assign-subject.update',$assignSubjects[0]->class_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="add_item">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Class Name</label>
                                            <select name="class_id" class="form-control" style="padding: 5px">
                                                <option value="">Please, Select Class</option>
                                                @foreach ($classes as $cls)
                                                    <option value="{{ $cls->id }}" {{ $cls->id == $assignSubjects[0]->class_id ? 'selected' : '' }} >{{ $cls->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                @foreach ($assignSubjects as $sub)
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                <div class="form-row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Subject</label>
                                          <select name="subject_id[]" class="form-control" style="padding: 5px">
                                              <option value="">Please, Select subject</option>
                                              @foreach ($subjects as $subject)
                                                  <option value="{{ $subject->id }}" {{ $subject->id == $sub->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="full_mark">Full Mark</label>
                                          <input type="text" name="full_mark[]" class="form-control" id="full_mark" value="{{ $sub->full_mark }}">
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="pass_mark">Pass Mark</label>
                                          <input type="text" name="pass_mark[]" class="form-control" id="pass_mark" value="{{ $sub->pass_mark }}">
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                          <label for="get_mark">Subjective Mark</label>
                                          <input type="text" name="get_mark[]" class="form-control" id="get_mark" value="{{ $sub->get_mark }}">
                                      </div>
                                  </div>
                                  <div class="col-md-2" style="margin-top: 28px">
                                    <div class="form-row">
                                      <span class="btn btn-sm badge-info mr-1 addeventmore"><i class="fas fa-plus-circle"></i></span>
                                      <span class="btn btn-sm badge-danger removeeventmore"><i class="fas fa-minus-circle"></i></span>
                                    </div>
                                  </div>
                              </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                        </form>
                        <div style="display: none;">
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Subject</label>
                                                <select name="subject_id[]" class="form-control" style="padding: 5px">
                                                    <option value="">Please, Select subject</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="full_mark">Full Mark</label>
                                                <input type="text" name="full_mark[]" class="form-control" id="full_mark">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="pass_mark">Pass Mark</label>
                                                <input type="text" name="pass_mark[]" class="form-control" id="pass_mark">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="get_mark">Subjective Mark</label>
                                                <input type="text" name="get_mark[]" class="form-control" id="get_mark">
                                            </div>
                                        </div>
                                        <div class=" form-group col-md-2">
                                            <div class="form-row" style="margin-top: 28px">
                                                <span class="btn btn-sm badge-info mr-1 addeventmore"><i
                                                        class="fas fa-plus-circle"></i></span>
                                                <span class="btn btn-sm badge-danger removeeventmore"><i
                                                        class="fas fa-minus-circle"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $(document).on("click", ".addeventmore", function() {
                    var whole_extra_item_add = $("#whole_extra_item_add").html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    counter++;
                });
                $(document).on("click", ".removeeventmore", function(event) {
                    var whole_extra_item_add = $("#whole_extra_item_add").html();
                    $(this).closest(".delete_whole_extra_item_add").remove();
                    counter -= 1;
                });
            })
        </script>
    @endpush
@endsection
