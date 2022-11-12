@extends('layouts.app_admin')
   
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="row">
                
                    <form action="#" method="get" autocomplete="off">
                        <div class="row">         
                            <div class="col-md-4 col-sm-4 pt-2">
                                <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                                    <label class="pt-1">Employee Name</label>
                                    <div class="col-md-12 col-sm-12 px-3">
                                        <div class="input-group input-group-sm">
                                            <select name="emp_name" class="form-control select2">
                                                <option value="">-----Select-----</option>                                                
                                                @foreach ($employee as $value)
                                                    <option value="{{ $value->id }}">{{ $value->full_name }}</option>
                                                @endforeach                                          
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 pt-2">
                                <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                                    {{-- <label class="col-md-2 col-sm-2 m-0 pt-1">Contact Name</label> --}}
                                    <label class="pt-1">Contact Name</label>
                                    <div class="col-md-12 col-sm-12 px-3">
                                        <div class="input-group input-group-sm">
                                            <select name="contact_name" class="form-control select2">
                                                <option value="">-----Select-----</option>
                                                @foreach ($contact_names as $cname)
                                                <option value="{{ $cname->id }}">{{ $cname->contact_name }}</option>
                                                @endforeach                                          
                                            </select>
                                        </div> 
                                    </div>
                    
                                </div>
                                
                            </div>
                            <div class="col-md-3 col-sm-3 pt-2">
                                <div class="row">
                                    <label class="form-label" for="inputPassword">Status</label>
                                    <div class="row">
                                            <div class="col-md-6">
                                            Active  <input type="radio" class="form-check-input" name="status" value="1" id="status" checked>
                                            </div>
                                            <div class="col-md-6 ">
                                            Inactive  <input type="radio" class="form-check-input" value="0" name="status" id="status"> 
                                            </div>
                                        
                                    </div>
                                </div>                                                 
                            </div>
                            <div class="col-md-1 col-sm-1 text-right pr-2 pt-2 pr-2 ">
                                <button type="submit" class="btn btn-primary btn-sm btn-block" id="application_custom_search"><i class="fa fa-search mr-2 p-2"
                                        aria-hidden="true"></i>Search
                                </button>
                            </div>                   
                    
                        </div>
                    </form>
                
            </div>
        </div>
        <div class="col-md-8">
                <a class="btn btn-info" href="{{ route('employee.create') }}">
                    Add Employee
                </a>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Name</th>
                        <th>Contact Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key=>$employee)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$employee->full_name}}</th>
                        <th>{{$employee->contact_name}}</th>
                        <th>{{$employee->email}}</th>
                        <th>
                            @if($employee->status==1)
                            <span class="badge bg-primary">Active</span> 
                            @else
                            <span class="badge bg-primary">Deactive</span>                         
                            @endif
                        </th>
    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection