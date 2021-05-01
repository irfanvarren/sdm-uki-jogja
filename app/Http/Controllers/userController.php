<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryGajiModel;
use App\UserModel;
use DB;

class userController extends Controller
{
	public function getAll(Request $request)
	{
		$user = new UserModel();

		if($request->id_user != ""){
			$user = $user->find($request->id_user);
			return response()->json($user,200);
		}else{

		if($request->scope == "user"){
			$id_user = $request->user()->id_user;
			$user = $user->where('user.id_user',$id_user);
		
		}else if($request->scope == "kepala-unit"){
			$unit_kerja = $request->user('kepala-unit')->unit_kerja;
			$user = $user->join('unit_kerja','unit_kerja.id_user','user.id_user')->where('unit_kerja.unit_kerja',$unit_kerja);
		}

		if($request->data == "cuti"){
			$user = $user->selectRaw('cuti_staff.id_user,user.nip,user.nama_lengkap,max(cuti_staff.tanggal_akhir) as tanggal_akhir')->leftJoin('cuti_staff','user.id_user','=','cuti_staff.id_user')->groupByRaw('cuti_staff.id_user,user.nip,user.nama_lengkap');
		}else if($request->data == "gaji"){
			$user = HistoryGajiModel::selectRaw('user.id_user,user.nip,user.nama_lengkap,sum(if(item_gaji.kelompok = "Penerimaan" AND history_gaji.bulan = '.$request->bulan.',history_gaji.jumlah,0)) - sum(if(item_gaji.kelompok = "Potongan" AND history_gaji.bulan = '.$request->bulan.',history_gaji.jumlah,0)) as gaji')->rightJoin('user','user.nip','history_gaji.NIP')->leftJoin('item_gaji','item_gaji.id_item','history_gaji.id_item');
			if($request->scope == "user"){
				$id_user = $request->user()->id_user;
				$user = $user->where('user.id_user',$id_user);
			}if($request->scope == "kepala-unit"){
			$unit_kerja = $request->user('kepala-unit')->unit_kerja;
			$user = $user->leftJoin('unit_kerja','unit_kerja.id_user','user.id_user')->where('unit_kerja.unit_kerja',$unit_kerja);
			}
			$user = $user->groupByRaw('user.id_user,user.nip,user.nama_lengkap,history_gaji.nip');
		}else if($request->data == "unit-kerja"){
			$user = $user->selectRaw('user.nip,user.nama_lengkap,user.id_user,(select unit_kerja.unit_kerja from unit_kerja where unit_kerja.id_user = user.id_user order by tanggal DESC limit 1) as unit_kerja')->groupBy('user.nip','user.nama_lengkap','user.id_user','unit_kerja');
		}else if($request->data == "pendidikan"){
			$user = $user->selectRaw('user.nip,user.nama_lengkap,user.id_user,(select jenjang from pendidikan_staff where pendidikan_staff.id_user = user.id_user order by tanggal_ijazah DESC limit 1) as jenjang')->groupBy('user.nip','user.nama_lengkap','user.id_user','jenjang');
		}else if($request->data == "jabatan-struktural"){
			$user = $user->selectRaw('user.nip,user.nama_lengkap,user.id_user,(select jabatan_struktural.jabatan_struktural from jabatan_struktural where jabatan_struktural.id_user = user.id_user order by tanggal DESC limit 1) as jabatan_struktural')->groupBy('user.nip','user.nama_lengkap','user.id_user','jabatan_struktural');
		}else if($request->data == "gol-ruang"){
			$user = $user->selectRaw('user.nip,user.nama_lengkap,user.id_user,(select gol_ruang.golongan from gol_ruang where gol_ruang.id_user = user.id_user order by gol_ruang.tanggal DESC limit 1) as golongan')->groupBy('user.nip','user.nama_lengkap','user.id_user','golongan');
		}else if($request->data == "jafa"){
			$user = $user->selectRaw('user.nip,user.nama_lengkap,user.id_user,(select jafa_dosen.jafa from jafa_dosen where jafa_dosen.id_user = user.id_user order by jafa_dosen.tanggal DESC limit 1) as jafa')->groupBy('user.nip','user.nama_lengkap','user.id_user','jafa');
		}

		
		return response()->json($user->get(),200);
		}
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
