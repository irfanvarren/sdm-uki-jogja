<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitModel;
class unitController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(UnitModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(UnitModel::find($request->id),200);
        }
        return response()->json(UnitModel::all(),200);
    }

    public function updateData($id , Request $req){
        $check = UnitModel::firstWhere('id_unit',$id);
     
        if($check){
            $data = UnitModel::find($id);
            $data->nama_unit= $req->nama_unit;
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
        UnitModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }

    public function delData($id){
        $check = UnitModel::firstWhere('id_unit',$id);
        if($check){
            UnitModel::destroy($id);
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
