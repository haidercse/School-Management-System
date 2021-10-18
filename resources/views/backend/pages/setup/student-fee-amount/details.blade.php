@extends('backend.layouts.master')

@section('title')
   Details Student-Fee-Amount | Setup Management
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Fee Amount Details</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('student-fee-amount.index') }}" class="float-right btn btn-info"><i class="fas fa-list"> fee Amount List</i></a>
                    </div>
                    <div class="card-body">
                       <div class="card-header mb-3 text-center">
                         <h3>{{ $amounts[0]->feeCategory->name }}</h3> 
                       </div>
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Class Name</th>
                                    <th scope="col">Amount</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($amounts as $amount)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $amount->class->name }}</td>
                                        <td>{{ $amount->amount }}</td>
                                        
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
