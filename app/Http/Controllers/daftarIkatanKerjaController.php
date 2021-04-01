<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarIkatanKerjaModel;

class daftarIkatanKerjaController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(DaftarIkatanKerjaModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(DaftarIkatanKerjaModel::find($request->id),200);
        }
        return response()->json(DaftarIkatanKerjaModel::all(),200);
    }

    public function updateData($id , Request $req){
        $check = DaftarIkatanKerjaModel::firstWhere('id_ikatan_kerja',$id);
     
        if($check){
            $data = DaftarIkatanKerjaModel::find($id);
            $data->nama_ikatan_kerja= $req->nama_ikatan_kerja;
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id item tidak ditemukan',
            ],404);
        }
    }

    public function addData(Request $req){
        UnitMDaftarIkatanKerjaModelodel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }

    public function delData($id){
        $check = DaftarIkatanKerjaModel::firstWhere('id_ikatan_kerja',$id);
        if($check){
            DaftarIkatanKerjaModel::destroy($id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id item tidak ditemukan',
            ],404);
        }
    }
}
