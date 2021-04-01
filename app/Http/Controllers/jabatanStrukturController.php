<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JabatanStrukturModel;


class jabatanStrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        if($request->id_user != ""){
            return response()->json(JabatanStrukturModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(JabatanStrukturModel::find($request->id),200);
        }
    	return response()->json(JabatanStrukturModel::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $req)
    {
    	$data = $req->except('file_sk');
    	if($req->hasFile('file_sk')){
    		$file = $req->file('file_sk');
    		$path_file = $file->storeAs('uploads/data-staff/'.$req->id_user.'/jabatan-struktural',$req->no_sk.'.'.$file->getClientOriginalExtension(),'public');
    		$data['file_sk'] = $path_file;
    	}

    	$input = $req->all();

    	$data = JabatanStrukturModel::create($input);
    	return response()->json([
    		"status" => "OK",
    		"message" => "Data berhasil ditambahkan"
    	],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $req, $id)
    {
    	$check = JabatanStrukturModel::firstWhere('id_jabatan_struktural',$id);
    	if($check){
    		$data = $req->except('file_sk');
    		if($req->hasFile('file_sk')){
    			$file = $req->file('file_sk');
    			  $path_file = $file->storeAs('uploads/data-staff/'.$check->id_user.'/jabatan-struktural',$req->no_sk.'.'.$file->getClientOriginalExtension(),'public');
    			$data['file_sk'] = $path_file;
    		}
    		
    		JabatanStrukturModel::find($id)->update($data);
    		return response()->json([
    			"status" => "OK",
    			"message" => "Data Berhasil Diubah"
    		]);
    	}else{
    		return response()->json([
    			'status' => 'Not Found',
    			'message' => 'Id item tidak ditemukan',
    		],404);
    	}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delData($id)
    {
    	$check = JabatanStrukturModel::firstWhere('id_jabatan_struktural',$id);
    	if($check){
    		JabatanStrukturModel::destroy($id);
    		return response()->json([
    			"status" => "OK",
    			"message" => "Data Berhasil Dihapus"
    		]);
    	}else{
    		return response()->json([
    			'status' => 'Not Found',
    			'message' => 'Id jabatan struktural tidak ditemukan',
    		],404);
    	}
    }
}
