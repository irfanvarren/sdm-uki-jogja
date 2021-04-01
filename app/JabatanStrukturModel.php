<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanStrukturModel extends Model
{
    protected $table = "jabatan_struktural";
    protected $primaryKey = "id_jabatan_struktural";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_jabatan_struktural','id_user','tanggal','unit_kerja','jabatan_struktural','no_sk','file_sk'
    ];
}
