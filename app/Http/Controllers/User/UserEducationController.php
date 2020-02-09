<?php

namespace App\Http\Controllers\User;
use App\Models\user\usereducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Carbon\Carbon;

class UserEducationController extends Controller
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
        'user_id' => 'required',
        'institute_name' => 'required',
        'degree'         => 'required',
        'passing_year'   => 'required',
        'details'        => 'required',
          ],
          [
            'institute_name.required' => 'This filled is required',
            'degree.required'         => 'This filled is required',
            'passing_year.required'   => 'This filled is required',
            'details.required'        => 'This filled is required',
          ]);
      
       $insertedu=usereducation::create($input);
         if($insertedu){
           Session::flash('status','value');
          return redirect()->back();
          }else{
            Session::flash('error','value');
           return redirect()->back();
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
      $edit=usereducation::findOrFail($id);
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
       $getdata=usereducation::where('id', $id)->FirstorFail();
       $input=$request->all();
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
       usereducation::destroy($id);
        return redirect()->back();
    }
}
