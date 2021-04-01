<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarGolonganModel;

class daftarGolonganController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(DaftarGolonganModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(DaftarGolonganModel::find($request->id),200);
        }
        return response()->json(DaftarGolonganModel::all(),200);
    }

    public function updateData($id , Request $req){
        $check = DaftarGolonganModel::firstWhere('id_gol',$id);
     
        if($check){
            $data = DaftarGolonganModel::find($id);
            $data->nama_gol= $req->nama_gol;
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
        DaftarGolonganModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }

    public function delData($id){
        $check = DaftarGolonganModel::firstWhere('id_gol',$id);
        if($check){
            DaftarGolonganModel::destroy($id);
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
