<?php

namespace App\Http\Controllers;

use App\Models\Employeedetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
class EmployeedetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->employeedetailes = new Employeedetail();
    }

    public function index()
    {
        return $this->employeedetailes->get();
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
            $data = $request->all();
            $validator = Validator::make($data, [
                'employee_id' => 'required|integer',
                'address_1' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'address_2' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'mobile' => 'required|digits:10',
                'email' => 'required|email',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            //Request is valid, create new employeedetail
            $employeedetail = $this->employeedetailes->create($request->all());

            //Department created, return success response
            return response()->json([
                'success' => true,
                'message' => 'Employeedetail created successfully',
                'data' => $employeedetail
            ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employeedetailes  $employeedetailes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $employeedetail = $this->employeedetailes->find($id);
    
        if (!$employeedetail) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, employeedetail not found.'
            ], 400);
        }
    
        return $employeedetail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employeedetailes  $employeedetailes
     * @return \Illuminate\Http\Response
     */
    public function edit(Employeedetailes $employeedetailes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employeedetail  $employeedetailes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //Validate data
        $employeedetailes = Employeedetail::findOrFail($id);
        $data = $request->all();
            $validator = Validator::make($data, [
                'employee_id' => 'required|integer',
                'address_1' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'address_2' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'mobile' => 'required|digits:10',
                'email' => 'required|email',
            ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        //Request is valid, update employeedetailes
        $employeedetailes = $employeedetailes->update($request->all());

        //employeedetailes updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'employeedetailes updated successfully',
            'data' => $employeedetailes
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employeedetailes  $employeedetailes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employeedetailes $employeedetailes)
    {
         $employeedetail = Employeedetailes::findOrFail($id);
        if($employeedetail){
           $employeedetail->delete(); 
            return response()->json([
                'success' => true,
                'message' => 'Employeedetail deleted successfully'
                ], Response::HTTP_OK);
        }else{
             return response()->json([
                'success' => false,
                'message' => 'Employeedetail not deleted'
                ], Response::HTTP_OK);
        }
    }
}
