<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataStaffModel;

class dataStaffController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return response()->json(DataStaffModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(DataStaffModel::find($request->id),200);
        }
        return response()->json(DataStaffModel::all(),200);
    }

   

    public function addData(Request $req){


        $staff = DataStaffModel::create($req->all());
        $id_user = $staff->id_user;

        if($req->hasFile('upload_KK')){
            $file = $req->file('upload_KK');
            $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'kk.'.$file->getClientOriginalExtension(),'public');
            $staff->upload_KK = $path_file;
        }

        if($req->hasFile('upload_bpjs_suami_istri')){
            $file = $req->file('upload_bpjs_suami_istri');
            $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-suami-istri.'.$file->getClientOriginalExtension(),'public');
            $staff->upload_bpjs_suami_istri = $path_file;
        }

        if($req->hasFile('upload_bpjs_anak_1')){
            $file = $req->file('upload_bpjs_anak_1');
            $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-anak-1.'.$file->getClientOriginalExtension(),'public');
            $staff->upload_bpjs_anak_1 = $path_file;
        }

        if($req->hasFile('Upload_bpjs_anak_2')){
            $file = $req->file('Upload_bpjs_anak_2');
            $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-anak-2.'.$file->getClientOriginalExtension(),'public');
            $staff->Upload_bpjs_anak_2 = $path_file;
        }

        $staff->save();
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = DataStaffModel::firstWhere('id_staff',$id);

        if($check){
            $data = DataStaffModel::find($id);
            $id_user = $data->id_user;
            $data->Nama_suami_istri = $req->Nama_suami_istri;
            $data->ttl_suami_istri = $req->ttl_suami_istri;
            $data->no_npjs_suami_istri = $req->no_npjs_suami_istri;
            $data->nama_anak_1 = $req->nama_anak_1;
            $data->ttl_anak_1 = $req->ttl_anak_1;
            $data->no_bpjs_anak_1 = $req->no_bpjs_anak_1;
            $data->nama_anak_2 = $req->nama_anak_2;
            $data->ttl_anak_2 = $req->ttl_anak_2;
            $data->no_bpjs_anak_2 = $req->no_bpjs_anak_2;
            $data->jumlah_anak_setelah_2 = $req->jumlah_anak_setelah_2;

            if($req->hasFile('upload_KK')){
                $file = $req->file('upload_KK');
                $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'kk.'.$file->getClientOriginalExtension(),'public');
                $data->upload_KK = $path_file;
            }

            if($req->hasFile('upload_bpjs_suami_istri')){
                $file = $req->file('upload_bpjs_suami_istri');
                   $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-suami-istri.'.$file->getClientOriginalExtension(),'public');
                $data->upload_bpjs_suami_istri = $path_file;
            }

            if($req->hasFile('upload_bpjs_anak_1')){
                $file = $req->file('upload_bpjs_anak_1');
                $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-anak-1.'.$file->getClientOriginalExtension(),'public');
                $data->upload_bpjs_anak_1 = $path_file;
            }

            if($req->hasFile('Upload_bpjs_anak_2')){
                $file = $req->file('Upload_bpjs_anak_2');
                $path_file = $file->storeAs('uploads/data-staff/'.$id_user,'bpjs-anak-2.'.$file->getClientOriginalExtension(),'public');
                $data->Upload_bpjs_anak_2 = $path_file;
            }
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id Staff tidak ditemukan',
            ],404);
        }
    }
    public function delData($id){
        $check = DataStaffModel::firstWhere('id_staff',$id);
        if($check){
            DataStaffModel::destroy($id);
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
