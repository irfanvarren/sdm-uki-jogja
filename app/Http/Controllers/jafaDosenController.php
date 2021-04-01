<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JafaDosenModel;

class jafaDosenController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(JafaDosenModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(JafaDosenModel::find($request->id),200);
        }
        return response()->json(JafaDosenModel::all(),200);
    }
    public function addData(Request $req){
        $data = $req->except('file_sk');
        if($req->hasFile('file_sk')){
            $file = $req->file('file_sk');
            $path_file = $file->storeAs('uploads/data-staff/'.$req->id_user.'/jabatan-fungsional',$req->no_sk.'.'.$file->getClientOriginalExtension(),'public');
            $data['file_sk'] = $path_file;
        }
        JafaDosenModel::create($data);
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = JafaDosenModel::firstWhere('id_jafaDosen',$id);
        if($check){
            $data = JafaDosenModel::find($id);
            $data->tanggal = $req->tanggal;
            $data->jafa = $req->jafa;
            $data->no_sk = $req->no_sk;
            if($req->hasFile('file_sk')){
                $file = $request->file('file_sk');
                $path_file = $file->storeAs('uploads/data-staff/'.$data->id_user.'/jabatan-fungsional',$req->no_sk.'.'.$file->getClientOriginalExtension(),'public');
                $data->file_sk = $path_file;
            }
            $data->file_sk = $req->file_sk;
            $data->keterangan = $req->keterangan;
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id cuti tidak ditemukan',
            ],404);
        }
    }
    public function delData($id){
        $check = JafaDosenModel::firstWhere('id_jafaDosen',$id);
        if($check){
            JafaDosenModel::destroy($id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id Staff tidak ditemukan',
            ],404);
        }
    }
}
