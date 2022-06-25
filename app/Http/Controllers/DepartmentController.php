<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();
        $this->departments = new Department();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->departments->get();
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
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new department
        $department = $this->departments->create([
            'name' => $request->name
        ]);

        //Department created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'data' => $department
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = $this->departments->find($id);
    
        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, department not found.'
            ], 400);
        }
    
        return $department;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      
        //Validate data
        $department = Department::findOrFail($id);
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

          // dd($department->update(['name' => $request->name]));
        //Request is valid, update department
        $department = $department->update(['name' => $request->name]);

        //department updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'department updated successfully',
            'data' => $department
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $department = Department::findOrFail($id);
        if($department){
           $department->delete(); 
            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully'
                ], Response::HTTP_OK);
        }else{
             return response()->json([
                'success' => false,
                'message' => 'Department not deleted'
                ], Response::HTTP_OK);
        }

    }
}