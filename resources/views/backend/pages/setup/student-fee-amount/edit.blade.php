@extends('backend.layouts.master')

@section('title')
   Update Student-Fee-Amount Form | Setup Management
@endsection

@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Upadte Fee Amount Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('student-fee-amount.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back Fee Category List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('student-fee-amount.update',$amounts[0]->fee_category_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="add_item">
                              <div class="form-row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fee Category</label>
                                    <select name="fee_category_id"  class="form-control"  style="padding: 5px">
                                        <option value="">Please, Select fee category</option>
                                        @foreach ($FeeCategories as $category)
                                            <option value="{{ $category->id }}"{{ $category->id == $amounts[0]->fee_category_id ? 'selected' : ''  }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              @foreach ($amounts as $amount)
                              <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                <div class="form-row">
                                  <div class="col-md-5">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Class</label>
                                      <select name="class_id[]"  class="form-control" style="padding: 5px">
                                          <option value="">Please, Select Class</option>
                                          @foreach ($classes as $cls)
                                              <option value="{{ $cls->id }}" {{ $cls->id == $amount->class_id ? 'selected' : '' }} >{{ $cls->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="amount">Fee Amount</label>
                                    <input type="text" name="amount[]" class="form-control" id="amount" value="{{ $amount->amount }}">
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
                            <button class="btn btn-success" type="submit">Update!</button>
                        </form>
                        <div style="display: none;">
                          <div class="whole_extra_item_add" id="whole_extra_item_add">
                             <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                               <div class="form-row">
                                 <div class="col-md-5">
                                   <div class="form-group">
                                     <label for="exampleInputEmail1">Class</label>
                                     <select name="class_id[]"  class="form-control" style="padding: 5px">
                                         <option value="">Please, Select Class</option>
                                         @foreach ($classes as $cls)
                                             <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                         @endforeach
                                     </select>
                                   </div>
                                 </div>
                                 <div class="col-md-5">
                                   <div class="form-group">
                                    <label for="amount">Fee Amount</label>
                                    <input type="text" name="amount[]" class="form-control" id="amount">
                                   </div>
                                  </div>
                                 <div class=" form-group col-md-2">
                                   <div class="form-row" style="margin-top: 28px">
                                     <span class="btn btn-sm badge-info mr-1 addeventmore"><i class="fas fa-plus-circle"></i></span>
                                     <span class="btn btn-sm badge-danger removeeventmore"><i class="fas fa-minus-circle"></i></span>
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
           $(document).ready( function () {
             var counter = 0;
             $(document).on("click",".addeventmore", function () {
               var whole_extra_item_add = $("#whole_extra_item_add").html();
               $(this).closest(".add_item").append(whole_extra_item_add);
               counter ++;
             });
             $(document).on("click",".removeeventmore", function (event) {
               var whole_extra_item_add = $("#whole_extra_item_add").html();
               $(this).closest(".delete_whole_extra_item_add").remove();
               counter -= 1;
             });
           })
         
         </script>
     @endpush
@endsection