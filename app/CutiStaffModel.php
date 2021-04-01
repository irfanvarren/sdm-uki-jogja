<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutiStaffModel extends Model
{
    protected $table = "cuti_staff";
    protected $primaryKey = "id_cutiStaff";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_user','id_cutiStaff','tanggal_mulai','tanggal_akhir','jenis_cuti','nomor_surat','file_surat' 
    ];
}
