@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Attendance Report</div>

                <div class="card-body">
                    <div class="row pb-5">                
                        <form action="#" method="get" autocomplete="off">
                            <div class="row">         
                                <div class="col-md-4 col-sm-4 pt-2">
                                    <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                                        <div class="col-md-2 col-sm-2">
                                            <label class="pt-1">From</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10 px-3">
                                            <div class="input-group input-group-sm">
                                                <input type="date" name="from_date">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 pt-2">
                                    <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                                        <div class="col-md-2 col-sm-2">
                                            <label class="pt-1">To</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10 px-3">
                                            <div class="input-group input-group-sm">
                                                <input type="date" name="to_date">
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
                    <div class="text-center">
                            <h3>{{ $employee->full_name }}</h3>
                            <p>{{ $employee->email }}</p>
                    </div>
                    <table class="table">
                        <thead>
                           <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Date</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $key=>$attendance)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $attendance->full_name }}</td>
                                    <td>{{ $attendance->in_time }}</td>
                                    <td>{{ $attendance->out_time }}</td>
                                    <td>{{ $attendance->date }}</td>

                              
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
