<?php

namespace App\Http\Controllers\User;
use App\Models\User\user_emp_history;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Carbon\Carbon;

class UserEmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('index');
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
        $input=$request->all();
       $this->validate($request,[
            'user_id'       => 'required',
            'title'         => 'required',
            'company_name'  => 'required',
            'start_date'    => 'required',
            'emp_details'    => 'required',
      ],
          [
            'title.required'          => 'This filled is required',
            'company_name.required'   => 'This filled is required',
            'start_date.required'   => 'This filled is required',
            'emp_details.required'        => 'This filled is required',
          ]);
     user_emp_history::create($input);
     return redirect()->back();
      
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
     $edit=user_emp_history::findOrFail($id);
      echo json_encode($edit);
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
        $getdata=user_emp_history::where('id', $id)->FirstorFail();
       $input=$request->all();
       if(!empty($_POST['currently_working'])){
        $stillworking=$input['currently_working'];
         $input['end_date']= '';
       }
      

       $updatedata=$getdata->fill($input)->save();
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        user_emp_history::destroy($id);
        return redirect()->back();
    }
}
