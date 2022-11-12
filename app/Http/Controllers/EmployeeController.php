<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\EmployeeContact;
use Illuminate\Support\Facades\DB;
use Hash;
class EmployeeController extends Controller
{
    public function index(Request $request){
        $employee=Employee::get();
        $contact_names=EmployeeContact::get();
        if(!empty($request->all()))
        {
            $data=$request->all();
            $emp_name          = !empty($data['emp_name'])?$data['emp_name']:null;
            $contact_name      = !empty($data['contact_name'])?$data['contact_name']:null;
            $status          = !empty($data['status'])?$data['status']:null;
        }else{
            $emp_name           =null;
            $contact_name       =null;
            $status             =null;
        }
        
        if(!empty($emp_name) && ($contact_name==null) && !empty($status)){
            $employees=Employee::leftJoin('employee_contacts', function($join) {
                $join->on('employees.id', '=', 'employee_contacts.employee_id');
                })->where('employees.id',$emp_name)
                ->where('employees.status',$status)
                ->select('employees.*','employee_contacts.contact_name')
                ->get();
        }elseif(($emp_name==null) && !empty($contact_name) && !empty($status)){
            $employees=Employee::leftJoin('employee_contacts', function($join) {
                $join->on('employees.id', '=', 'employee_contacts.employee_id');
                })
                ->where('employee_contacts.id',$contact_name)
                ->where('employees.status',$status)
                ->select('employees.*','employee_contacts.contact_name')
                ->get();
        }
        elseif(!empty($emp_name) && !empty($contact_name) && !empty($status)){
            $employees=Employee::leftJoin('employee_contacts', function($join) {
                $join->on('employees.id', '=', 'employee_contacts.employee_id');
                })
                ->where('employee_contacts.id',$contact_name)
                ->where('employees.id',$emp_name)
                ->where('employees.status',$status)
                ->select('employees.*','employee_contacts.contact_name')
                ->get();
        }
        else{
            $employees=Employee::leftJoin('employee_contacts', function($join) {
                $join->on('employees.id', '=', 'employee_contacts.employee_id');
                })->select('employees.*','employee_contacts.contact_name')
                ->get();
        }

        // dd($employees);
        return view('pages.index',compact('employees','employee','contact_names'));
    } 

    public function create(){
        return view('pages.create');
    } 

    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);
        // store employee table data
        $employee=new Employee();
        $employee->first_name=$request->first_name;
        $employee->full_name=$request->full_name;
        $employee->email=$request->email;
        $employee->status=$request->status;
        $employee->password=Hash::make($request->password);
        $employee->save();

        $employee_get=DB::table('employees')->latest()->first();

        // store user table data
        $user=new User();
        $user->name=$request->full_name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
     
        // store employee detail table data
        $image = $request->photo;
        // dd($image);
        $image_name = hexdec(uniqid());
        $ext = strtolower($image->getClientOriginalExtension());
        $image_full_name = $request->first_name . '-' . $image_name . '.' . $ext;

        // print_r($image_full_name);
        $upload_path = 'employee/image/';
        $image_url = url('/') . $upload_path . $image_full_name;
        $image->move(public_path() . '/' . $upload_path, $image_full_name);
       
        $employeedetail=new EmployeeDetail();
        $employeedetail->employee_id=$employee_get->id;
        $employeedetail->address=$request->address;
        $employeedetail->phone=$request->phone;
        $employeedetail->photo=$image_url;
        $employeedetail->save();

        // store employee contact table data
        foreach($request->contact_name as $key=>$value){
            $employeecontact=new EmployeeContact();
            $employeecontact->employee_id=$employee_get->id;
            $employeecontact->contact_name=$value;
            $employeecontact->contact_mobile=$request->contact_phone[$key];
            $employeecontact->contact_email=$request->contact_name[$key];
            $employeecontact->save();
        }
        return redirect()->route('employees.index');

    } 


}
