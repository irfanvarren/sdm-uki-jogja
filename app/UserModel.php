<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;


class UserModel extends Authenticatable
{
    use HasApiTokens, Notifiable; 
    protected $table = "user";
    protected $primaryKey = "id_user";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_user','nik','nip','nama_lengkap','tempat_lahir','tanggal_lahir',
        'jenis_kelamin','agama','suku','warga_negara','gol_darah','status_nikah',
        'pasangan_bekerja_UKIT','tanggungan_anak','upload_ktp','alamat',
        'kelurahan','kecamatan','kota_kabupaten','provinsi','kodepos','nama_ibu',
        'alamat_ibu','jenis_staff','nomor_hp','email','kode_dosen','nidn','npwp',
        'upload_npwp','e_fin','status_pajak','gaji_pokok','norek_gaji','norek_nama',
        'bank_tf_gaji','info_buku_tabungan','kepala_keluarga','norek_pensiun','no_bpjs_kesehatan',
        'upload_bpjs_kesehatan','no_bpjs_tenagakerja','upload_bpjs_tenagakerja','upload_foto',
        'username_sim_sdm','password','reTypePassword'
    ];
}
