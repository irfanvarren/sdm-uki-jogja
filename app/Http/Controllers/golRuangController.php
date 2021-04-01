<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GolRuangModel;

class golRuangController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(GolRuangModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(GolRuangModel::find($request->id),200);
        }
        return response()->json(GolRuangModel::all(),200);
    }
    public function addData(Request $req){
        $data = $req->except('file_sk');
        if($req->hasFile('file_sk')){
            $file = $req->file('file_sk');
            $path_file = $file->store('uploads/file-sk','public');
            $data['file_sk'] = $path_file;
        }
        GolRuangModel::create($data);
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = GolRuangModel::firstWhere('id_golRuang',$id);
     
        if($check){
            $data = GolRuangModel::find($id);
            $data->tanggal = $req->tanggal;
            $data->golongan = $req->golongan;
            $data->ruang = $req->ruang;
            $data->no_sk = $req->no_sk;
            if($req->hasFile('file_sk')){
            $file = $req->file('file_sk');
            $path_file = $file->store('uploads/file-sk','public');
             $data->file_sk = $path_file;
            }
           
            $data->keterangan = $req->keterangan;
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id golongan tidak ditemukan',
            ],404);
        }
    }
    public function delData($id){
        $check = GolRuangModel::firstWhere('id_golRuang',$id);
        if($check){
            GolRuangModel::destroy($id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id golongan tidak ditemukan',
            ],404);
        }
    }
}
