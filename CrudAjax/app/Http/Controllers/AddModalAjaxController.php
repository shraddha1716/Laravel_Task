<?php

namespace App\Http\Controllers;

use App\Models\AddModalAjax;
use Illuminate\Http\Request;

class AddModalAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AddModalAjax');
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
        $data = new AddModalAjax();
        $data->name= $request->input('name');
        $data->save();
        return response()->json(['message'=>'data added successfully','data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddModalAjax  $addModalAjax
     * @return \Illuminate\Http\Response
     */
    public function show(AddModalAjax $addModalAjax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddModalAjax  $addModalAjax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AddModalAjax::find($id);
        return response()->json(['message'=>'success','data'=>$data]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddModalAjax  $addModalAjax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = AddModalAjax::find($id);
        $data->name= $request->input('name');
        $data->save();
        return response()->json(['message' => 'data updated successfully','data'=>$data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddModalAjax  $addModalAjax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AddModalAjax::find($id);
        $data->delete();
        return response()->json(['message' => 'data deleted successfully','data'=>$data]);
    }
}
