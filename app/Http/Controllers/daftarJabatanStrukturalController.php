<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarJabatanStrukturalModel;

class DaftarJabatanStrukturalController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(DaftarJabatanStrukturalModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(DaftarJabatanStrukturalModel::find($request->id),200);
        }
        return response()->json(DaftarJabatanStrukturalModel::all(),200);
    }

    public function updateData($id , Request $req){
        $check = DaftarJabatanStrukturalModel::firstWhere('id_js',$id);
     
        if($check){
            $data = UnitMDaftarJabatanStrukturalModelodel::find($id);
            $data->nama_js= $req->nama_js;
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
        DaftarJabatanStrukturalModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }

    public function delData($id){
        $check = DaftarJabatanStrukturalModel::firstWhere('id_js',$id);
        if($check){
            DaftarJabatanStrukturalModel::destroy($id);
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
