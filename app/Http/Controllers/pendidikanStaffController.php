<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PendidikanStaffModel;
use Validator;

class PendidikanStaffController extends Controller
{
    public function getAll(Request $request)
    {
        if($request->id_user != ""){
            return response()->json(PendidikanStaffModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(PendidikanStaffModel::find($request->id),200);
        }
     return response()->json(PendidikanStaffModel::all(),200);
 }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $req)
    {
        $data = $req->except('file_ijazah');
        if($req->hasFile('file_ijazah')){
            $file = $req->file('file_ijazah');
            $path_file = $file->storeAs('uploads/data-staff/'.$req->id_user.'/ijazah',$req->no_ijazah.'.'.$file->getClientOriginalExtension(),'public');
            $data['file_ijazah'] = $path_file;
        }
        PendidikanStaffModel::create($data);
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
        $check = PendidikanStaffModel::firstWhere('id_pendidikan_staff',$id);
      if($check){
          $data = $req->except('file_ijazah');
       if($req->hasFile('file_ijazah')){
        $file = $req->file('file_ijazah');
        $path_file = $file->storeAs('uploads/data-staff/'.$check->id_user.'/ijazah',$req->no_ijazah.'.'.$file->getClientOriginalExtension(),'public');
        $data['file_ijazah'] = $path_file;
    }
    PendidikanStaffModel::find($id)->update($data);
    return response()->json([
        "status" => "OK",
        "message" => "Data berhasil diubah"
    ],200);
}else{
   return response()->json([
    'status' => 'Not Found',
    'message' => 'Id pendidikan staff tidak ditemukan',
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
        $check = PendidikanStaffModel::firstWhere('id_pendidikan_staff',$id);
        if($check){
            $data = PendidikanStaffModel::find($id)->delete();
            return response()->json([
                "status" => "OK",
                "message" => "Data berhasil dihapus"
            ]);
        }else{
         return response()->json([
            'status' => 'Not Found',
            'message' => 'Id pendidikan staff tidak ditemukan',
        ],404);
     }
 }
}
