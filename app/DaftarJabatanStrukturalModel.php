<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarJabatanStrukturalModel extends Model
{
    protected $table = "daftar_jabatan_struktural";
    protected $primaryKey = "id_js";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_js','nama_js'
    ];
}
