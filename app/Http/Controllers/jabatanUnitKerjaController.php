<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JabatanUnitKerjaModel;

class jabatanUnitKerjaController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(jabatanUnitKerjaModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(jabatanUnitKerjaModel::find($request->id),200);
        }
        return response()->json(jabatanUnitKerjaModel::all(),200);
    }

    public function updateData($id , Request $req){
        $check = jabatanUnitKerjaModel::firstWhere('id_jabatan_unit_kerja',$id);
     
        if($check){
            $data = jabatanUnitKerjaModel::find($id);
            $data->nama_jafa = $req->nama_jafa;
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
        jabatanUnitKerjaModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }

    public function delData($id){
        $check = jabatanUnitKerjaModel::firstWhere('id_jabatan_unit_kerja',$id);
        if($check){
            jabatanUnitKerjaModel::destroy($id);
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
