<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;

class userController extends Controller
{
	public function getAll(Request $request)
	{
		if($request->data == "cuti"){
			$response = UserModel::selectRaw('cuti_staff.id_user,user.nip,user.nama_lengkap,max(cuti_staff.tanggal_akhir) as tanggal_akhir')->join('cuti_staff','user.id_user','=','cuti_staff.id_user')->groupByRaw('cuti_staff.id_user,user.nip,user.nama_lengkap')->get();
			return response()->json($response,200);
		}
		
		return response()->json(UserModel::all(),200);
	}


	 public function filter(Request $req){
        $data = new UserModel();
        if($req->jenis_kelamin != ""){
            $data->where('jenis_kelamin',$req->jenis_kelamin);
        }

        if($req->status_nikah != ""){
            $data->where('status_nikah',$req->status_nikah);
        }

        if($req->pasangan_bekerja_UKIT != ""){
            $data->where('pasangan_bekerja_UKIT',$req->pasangan_bekerja_UKIT);
        }

        if($req->jenis_staff != ""){
            $data->where('jenis_staff',$req->jenis_staff);
        }


        $data = $data->get();
        return response()->json($data,200);
    }

	public function addData(Request $req)
	{
	

$data = UserModel::create($req->all());
$id_user = $data->id_user;
if($req->hasFile('upload_ktp')){
	$file = $req->file('upload_ktp');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'ktp.'.$file->getClientOriginalExtension(),'public');
	$data->upload_ktp = $path_file;
}

if($req->hasFile('upload_npwp')){
	$file = $req->file('upload_npwp');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'npwp.'.$file->getClientOriginalExtension(),'public');
	$data->upload_npwp = $path_file;
}

if($req->hasFile('upload_bpjs_kesehatan')){
	$file = $req->file('upload_bpjs_kesehatan');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'bpjs-kesehatan.'.$file->getClientOriginalExtension(),'public');
	$data->upload_bpjs_kesehatan = $path_file;
}

if($req->hasFile('upload_bpjs_tenagakerja')){
	$file = $req->file('upload_bpjs_tenagakerja');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'bpjs-tenagakerja.'.$file->getClientOriginalExtension(),'public');
	$data->upload_bpjs_tenagakerja = $path_file;
}
if($req->hasFile('upload_foto')){
	$file = $req->file('upload_foto');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'foto.'.$file->getClientOriginalExtension(),'public');
	$data->upload_foto = $path_file;
}

if($req->hasFile('info_buku_tabungan')){
	$file = $req->file('info_buku_tabungan');
	$path_file = $file->storeAs('uploads/data-user/'.$id_user,'info_buku_tabungan.'.$file->getClientOriginalExtension(),'public');
	$data->info_buku_tabungan = $path_file;
}
$data->save();
return response()->json([
	"status" => "OK",
	"message" => "Data berhasil ditambahkan",
],200);
}


public function updateData(Request $req, $id)
{
	$check = UserModel::firstWhere('id_user',$id);
	if($check){
		$data = $req->except('upload_ktp','upload_npwp','upload_bpjs_kesehatan','upload_bpjs_tenagakerja','upload_foto');
		if($req->hasFile('upload_ktp')){
			$file = $req->file('upload_ktp');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'ktp.'.$file->getClientOriginalExtension(),'public');
			$data['upload_ktp'] = $path_file;
		}

		if($req->hasFile('upload_npwp')){
			$file = $req->file('upload_npwp');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'npwp.'.$file->getClientOriginalExtension(),'public');
			$data['upload_npwp'] = $path_file;
		}

		if($req->hasFile('upload_bpjs_kesehatan')){
			$file = $req->file('upload_bpjs_kesehatan');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'bpjs-kesehatan.'.$file->getClientOriginalExtension(),'public');
			$data['upload_bpjs_kesehatan'] = $path_file;
		}

		if($req->hasFile('upload_bpjs_tenagakerja')){
			$file = $req->file('upload_bpjs_tenagakerja');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'bpjs-tenagakerja.'.$file->getClientOriginalExtension(),'public');
			$data['upload_bpjs_tenagakerja'] = $path_file;
		}
		if($req->hasFile('upload_foto')){
			$file = $req->file('upload_foto');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'foto.'.$file->getClientOriginalExtension(),'public');
			$data['upload_foto'] = $path_file;
		}
		if($req->hasFile('info_buku_tabungan')){
			$file = $req->file('info_buku_tabungan');
			$path_file = $file->storeAs('uploads/data-user/'.$id,'info_buku_tabungan.'.$file->getClientOriginalExtension(),'public');
			$data['info_buku_tabungan'] = $path_file;
		}
		UserModel::find($id)->update($data);
		return response()->json([
			"status" => "OK",
			"message" => "Data berhasil diubah"
		],200);
	}else{
		return response()->json([
			'status' => 'Not Found',
			'message' => 'Id user tidak ditemukan',
		],404);
	}
}

public function delData($id)
{
	$check = UserModel::firstWhere('id_user',$id);
	if($check){
		$data = UserModel::find($id)->delete();
		return response()->json([
			"status" => "OK",
			"message" => "Data berhasil dihapus"
		]);
	}else{
		return response()->json([
			'status' => 'Not Found',
			'message' => 'Id user tidak ditemukan',
		],404);
	}
}
}
