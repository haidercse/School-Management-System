@extends('backend.layouts.master')

@section('title')
    Student-Fee-Amount | Setup Management
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Fee Amount Name list</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('student-fee-amount.create') }}" class="float-right btn btn-info"><i class="fas fa-plus-circle"> Add Fee Amount</i></a>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fee Category Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($amounts as $amount)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $amount->feeCategory->name }}</td>
                                        <td>
                                            <a href="{{ route('student-fee-amount.show',$amount->fee_category_id) }}"
                                                class="btn btn-info"><i class="far fa-eye"> Details</i></a>
                                            <a href="{{ route('student-fee-amount.edit',$amount->fee_category_id) }}"
                                                class="btn btn-success"><i class="far fa-edit"> Edit</i></a>
                                               
                                        </td>
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
