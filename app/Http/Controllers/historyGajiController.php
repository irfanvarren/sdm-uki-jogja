<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryGajiModel;

class historyGajiController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(HistoryGajiModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(HistoryGajiModel::find($request->id),200);
        }
        return response()->json(HistoryGajiModel::all(),200);
    }
    public function addData(Request $req){
        HistoryGajiModel::create($req->all());
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = HistoryGajiModel::firstWhere('id_history',$id);
     
        if($check){
            $data = HistoryGajiModel::find($id);
            $data->tanggal = $req->tanggal;
            $data->bulan = $req->bulan;
            $data->tahun = $req->tahun;
            $data->NIP = $req->NIP;
            $data->id_item = $req->id_item;
            $data->jumlah = $req->jumlah;
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id history tidak ditemukan',
            ],404);
        }
    }
    public function delData($id){
        $check = HistoryGajiModel::firstWhere('id_history',$id);
        if($check){
            HistoryGajiModel::destroy($id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id history tidak ditemukan',
            ],404);
        }
    }
}
