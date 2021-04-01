<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CutiStaffModel;

class cutiStaffController extends Controller
{
    public function getAll(Request $request){
        if($request->id_user != ""){
            return  response()->json(CutiStaffModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(CutiStaffModel::find($request->id));
        }
        return response()->json(CutiStaffModel::selectRaw('cuti_staff.id_user,user.nip,user.nama_lengkap,max(cuti_staff.tanggal_akhir) as tanggal_akhir')->join('user','user.id_user','=','cuti_staff.id_user')->groupByRaw('cuti_staff.id_user,user.nip,user.nama_lengkap')->get(),200);
    }
    public function addData(Request $req){
        $data = $req->except('file_surat');
        if($req->hasFile('file_surat')){
            $file = $req->file('file_surat');
            $path_file = $file->storeAs('uploads/data-staff/'.$req->id_user.'/cuti',$req->nomor_surat.'.'.$file->getClientOriginalExtension(),'public');
            $data['file_surat'] = $path_file;
        }
        CutiStaffModel::create($data);
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = CutiStaffModel::firstWhere('id_cutiStaff',$id);

        if($check){
            $data = CutiStaffModel::find($id);
            $data->tanggal_mulai = $req->tanggal_mulai;
            $data->tanggal_akhir = $req->tanggal_akhir;
            $data->jenis_cuti = $req->jenis_cuti;
            $data->nomor_surat = $req->nomor_surat;
            if($req->hasFile('file_surat')){
                $file = $req->file('file_surat');
                $path_file = $file->storeAs('uploads/data-staff/'.$data->id_user.'/cuti',$req->nomor_surat.'.'.$file->getClientOriginalExtension(),'public');
                $data->file_surat = $path_file;
            }
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
        $check = CutiStaffModel::firstWhere('id_cutiStaff',$id);
        if($check){
            CutiStaffModel::destroy($id);
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
