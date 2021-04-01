<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemGajiModel;

class itemGajiController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(ItemGajiModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(ItemGajiModel::find($request->id),200);
        }
        return response()->json(ItemGajiModel::all(),200);
    }
    public function addData(Request $req){
        ItemGajiModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = ItemGajiModel::firstWhere('id_item',$id);
     
        if($check){
            $data = ItemGajiModel::find($id);
            $data->kelompok = $req->kelompok;
            $data->item = $req->item;
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
    public function delData($id){
        $check = ItemGajiModel::firstWhere('id_item',$id);
        if($check){
            ItemGajiModel::destroy($id);
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
