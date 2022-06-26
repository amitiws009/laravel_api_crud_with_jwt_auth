<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employeedetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->employees = new Employee();
        $this->employeedetail = new Employeedetail();
    }
    public function index()
    {

         return $data = Employee::with(['employeedetails' => function($query) {
     $query->select(['id', 'name', 'department_id']);
 }])->get();
        // return $this->employees->get();
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
        $data =  $request->all();
        $validator = Validator::make($data, [
            'department_id' => 'required|integer',
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new employee
        $employee = $this->employees->create($request->all());
     
        //Department created, return success response
        return response()->json([
            'success' => true,
            'message' => 'New Employee Added successfully',
            'data' => $employee
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with(['employeedetail' => function($query) {
             $query->select('*');
         }])->get();
    
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, employee not found.'
            ], 400);
        }
    
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'department_id' => 'required|integer',
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        //Request is valid, update employee
        $employee = $employee->update($request->all());

        //employee updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'employee updated successfully',
            'data' => $employee
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if($employee){
           $employee->employeedetail()->delete(); 
           $employee->delete(); 
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully'
                ], Response::HTTP_OK);
        }else{
             return response()->json([
                'success' => false,
                'message' => 'Employee not deleted'
                ], Response::HTTP_OK);
        }
    }
}
