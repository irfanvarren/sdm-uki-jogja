<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendidikanStaffModel extends Model
{
    protected $table = "pendidikan_staff";
    protected $primaryKey = "id_pendidikan_staff";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_pendidikan_staff','id_user','tanggal_ijazah','jenjang','gelar','bidang_studi','perguruan_tinggi','no_ijazah','file_ijazah'
    ];
}
