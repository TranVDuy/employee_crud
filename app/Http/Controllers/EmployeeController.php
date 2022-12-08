<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $list = $this->employee::orderBy('id', 'DESC')->get();
            return response()->json([
                'data'=>$list
            ]);
        }
        catch (Exception $e)
        {
            Log::error($e);
        }

    }

    /**
     * Display a listing employee with paginate
     *
     * @return \Illuminate\Http\Response
     */

    public function getlistpaginate()
    {
        try {
            $list = $this->employee::orderBy('id', 'DESC')->paginate(5);;
            return response()->json([
                'data'=>$list
            ]);
        }
        catch (Exception $e)
        {
            Log::error($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $dataCreate = $request->all();
//            $employee = $this->employee->create([
//                'employee_name' => $dataCreate->employee_name,
//                'salary' => $dataCreate->salary
//            ]);

            $employee = $this->employee->create($dataCreate);

            return response()->json([
                'message' => 'Create employee success'
            ]);
        }
        catch (\Exception $e){
            Log::error($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $employee = $this->employee->findOrFail($id);

            return response()->json([
                'data' => $employee
            ]);
        }
        catch (\Exception $e){
            Log::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $employee = $this->employee->findOrFail($id);
            $employee->update([
                'employee_name'=>$request->employee_name,
                'salary'=>$request->salary
            ]);

            return response()->json([
                'message'=>'Update success employee by id: '.$id
            ]);
        }
        catch (\Exception $e){
            Log::error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $employee = $this->employee->findOrFail($id);
            $employee->delete();

            return  response()->json([
                'message'=>'Delete success by id '.$id
            ]);
        }
        catch (\Exception $e){
            Log::error($e);
        }
    }
}
