<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $attendances= EmployeeAttendance::get();
        return view('pages.attendance.index',compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $insert=new EmployeeAttendance();
        $insert->employee_id=$request->employee_id;
        $insert->in_time=$request->time;
        $insert->date=$request->date;

        $success=   $insert->save();
        return json_encode($success);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        $update=EmployeeAttendance::where('employee_id', $request->employee_id)
        ->where('date', $request->date)
        ->update([
            'out_time' => $request->time,
         ]);
        return json_encode($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list()
    {
        $user_email=Auth::user()->email;
        $date = Carbon::now();
        // dd($date)
        $employee_id=Employee::where('email',$user_email)->first();
        $attendances=EmployeeAttendance::leftJoin('employees', function($join) {
            $join->on('employees.id', '=', 'employee_attendances.employee_id');
            })
            ->where('employees.email',$user_email)
            ->select('employees.full_name','employee_attendances.*')
            ->get();
        $attendance=EmployeeAttendance::leftJoin('employees', function($join) {
            $join->on('employees.id', '=', 'employee_attendances.employee_id');
            })
            ->where('employees.email',$user_email)
            ->whereDate('employee_attendances.date',$date)
            ->select('employees.full_name','employee_attendances.*')
            ->latest()->first();
            // dd($attendance);
        return view('pages.attendance.list',compact('attendances','attendance','employee_id'));
    }
    public function report(Request $request){
        // dd($request);
        $user_email=Auth::user()->email;
        $employee=Employee::where('email',$user_email)->first();
        if(!empty($request->all()))
        {
            $data=$request->all();
            $to_date          = !empty($data['to_date'])?$data['to_date']:null;
            $from_date      = !empty($data['from_date'])?$data['from_date']:null;
        }else{
            $from_date           =null;
            $to_date       =null;
        }

        if(!empty($to_date) && !empty($from_date)){
            $attendances=EmployeeAttendance::leftJoin('employees', function($join) {
                $join->on('employees.id', '=', 'employee_attendances.employee_id');
                })
                ->where('employees.email',$user_email)
                ->where('date', '>=', $from_date)
                ->where('date', '<=', $to_date)
                ->select('employees.full_name','employee_attendances.*')
                ->get();
        }       
        else{
            $attendances=EmployeeAttendance::leftJoin('employees', function($join) {
                $join->on('employees.id', '=', 'employee_attendances.employee_id');
                })
                ->where('employees.email',$user_email)
                ->select('employees.full_name','employee_attendances.*')
                ->get();
        }
        return view('pages.attendance.report',compact('attendances','employee'));
    }
    public function adminreport(Request $request){
        // dd($request);
        
        $employees=Employee::get();
        if(!empty($request->all()))
        {
            $data=$request->all();
            $employee_id    = !empty($data['employee_id'])?$data['employee_id']:null;
            $to_date        = !empty($data['to_date'])?$data['to_date']:null;
            $from_date      = !empty($data['from_date'])?$data['from_date']:null;
        }else{
            $employee_id    =null;
            $from_date      =null;
            $to_date        =null;
        }
        
        if(!empty($to_date) && !empty($from_date)){
            $attendances=EmployeeAttendance::leftJoin('employees', function($join) {
                $join->on('employees.id', '=', 'employee_attendances.employee_id');
                })
                ->where('employee_attendances.employee_id',$employee_id)
                ->where('employee_attendances.date', '>=', $from_date)
                ->where('employee_attendances.date', '<=', $to_date)
                ->select('employees.full_name','employee_attendances.*')
                ->get();
        }       
        else{
            $attendances=EmployeeAttendance::leftJoin('employees', function($join) {
                $join->on('employees.id', '=', 'employee_attendances.employee_id');
                })
                ->select('employees.full_name','employee_attendances.*')
                ->get();
        }
        if(!empty($attendances)){
            $employee=Employee::where('id',$employee_id)->first();
        }else{
            $employee=null;
        }
        return view('pages.attendance.adminreport',compact('attendances','employee','employees'));
    }
}
