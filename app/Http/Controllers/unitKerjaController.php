<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UnitKerjaModel;
use Validator;

class UnitKerjaController extends Controller
{
    public function getAll(Request $request)
    {
        if($request->id_user != ""){
            return response()->json(UnitKerjaModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(UnitKerjaModel::find($request->id),200);
        }
     return response()->json(UnitKerjaModel::all(),200);
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
            $path_file = $file->store('uploads/file_sk','public');
            $data['file_sk'] = $path_file;
        }
        UnitKerjaModel::create($data);
        return response()->json([
            "status" => "OK",
            "message" => "Data berhasil ditambahkan",
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
        $check = UnitKerjaModel::firstWhere('id_unit_kerja',$id);
      if($check){
        $data = $req->except('file_sk');
       if($req->hasFile('file_sk')){
        $file = $req->file('file_sk');
        $path_file = $file->store('uploads/file_sk','public');
        $data['file_sk'] = $path_file;
    }
    $data = UnitKerjaModel::find($id)->update($data);
    return response()->json([
        "status" => "OK",
        "message" => "Data berhasil diubah"
    ],200);
}else{
   return response()->json([
    'status' => 'Not Found',
    'message' => 'Id unit kerja tidak ditemukan',
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
        $check = UnitKerjaModel::firstWhere('id_unit_kerja',$id);
        if($check){
            $data = UnitKerjaModel::find($id)->delete();
            return response()->json([
                "status" => "OK",
                "message" => "Data berhasil dihapus"
            ]);
        }else{
         return response()->json([
            'status' => 'Not Found',
            'message' => 'Id unit kerja tidak ditemukan',
        ],404);
     }
 }
}
