<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IkatanKerjaModel;

class ikatanKerjaController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(IkatanKerjaModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(IkatanKerjaModel::find($request->id),200);
        }
        return response()->json(IkatanKerjaModel::all(),200);
    }
    public function addData(Request $req){
    $data = $req->except('file_sk');
    if($req->hasFile('file_sk')){
        $file = $req->file('file_sk');
        $path_file = $file->storeAs('uploads/data-staff/'.$req->id_user.'/ikatan-kerja',$req->nomor_sk.'.'.$file->getClientOriginalExtension(),'public');
        $data['file_sk'] = $path_file;
    }
    IkatanKerjaModel::create($data);
    return response()->json([
        'status' => 'OK',
        'message' => 'Data berhasil ditambahkan'
    ],200);
}
public function updateData($id , Request $req){
    $check = IkatanKerjaModel::firstWhere('id_ikatan_kerja',$id);

    if($check){
        $data = IkatanKerjaModel::find($id);
        $data->tanggal = $req->tanggal;
        $data->status = $req->status;
        $data->nomor_sk = $req->nomor_sk;
        if($req->hasFile('file_sk')){
            $file = $req->file('file_sk');
            $path_file = $file->storeAs('uploads/data-staff/'.$data->id_user.'/ikatan-kerja',$req->nomor_sk.'.'.$file->getClientOriginalExtension(),'public');
            $data->file_sk = $req->file_sk;
        }

        $data->save();
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diubah',
        ],200);
    }else{
        return response()->json([
            'status' => 'Not Found',
            'message' => 'Id ikatan tidak ditemukan',
        ],404);
    }
}
public function delData($id){
    $check = IkatanKerjaModel::firstWhere('id_ikatan_kerja',$id);
    if($check){
        IkatanKerjaModel::destroy($id);
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
        ],200);
    }else{
        return response()->json([
            'status' => 'Not Found',
            'message' => 'Id ikatan tidak ditemukan',
        ],404);
    }
}
}
