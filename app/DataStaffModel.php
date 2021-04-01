<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataStaffModel extends Model
{
    protected $table = "data_staff";
    protected $primaryKey = "id_staff";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_staff','id_user','Nama_suami_istri','ttl_suami_istri','no_npjs_suami_istri','upload_bpjs_suami_istri','nama_anak_1','ttl_anak_1','no_bpjs_anak_1','upload_bpjs_anak_1','nama_anak_2','ttl_anak_2','no_bpjs_anak_2','Upload_bpjs_anak_2','jumlah_anak_setelah_2','upload_KK'
    ];
}
