@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Attendance List</div>
                <input type="hidden" value="{{ $employee_id->id }}" id="employee_id">
                <input type="hidden" value="{{ date('H:i:s') }}" id="time">
                <input type="hidden" value="{{ date('Y-m-d') }}" id="date">                
                @if(empty($attendance))
                <div class="in_time p-2"><a class="btn btn-primary" href="#attend_in">In</a></div>
                @endif
                @if(empty($attendance->out_time))
                <div class="out_time p-2"><a class="btn btn-primary" href="#attend_out">Out</a></div>
                @endif
                <div class="card-body">
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
<script>
    $(document).on('click', '.in_time', function (ev) {
            var employee_id = $('#employee_id').val();
            var date = $('#date').val();
            var time = $('#time').val();
            alert(time);
            $.ajax({
                    type: 'POST',
                    url: "{{ route('attendance.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        employee_id: employee_id,
                        date: date,
                        time: time
                    },
                    success: function(data) {
                       console.log(data);
                
                            $('.in_time').hide();
                            $('.out_time').addClass("d-none");
                            location.reload();
                     
                    }
                });
    });
    $(document).on('click', '.out_time', function (ev) {
            var employee_id = $('#employee_id').val();
            var date = $('#date').val();
            var time = $('#time').val();
            // alert(time);
            $.ajax({
                    type: 'POST',
                    url: "{{ route('attendance.update') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        employee_id: employee_id,
                        date: date,
                        time: time
                    },
                    success: function(data) {
                       console.log(data);                
                            $('.out_time').remove();
                            location.reload();
                            // $('.out_time').addClass("d-none");
                     
                    }
                });
    });
</script>
@endsection
