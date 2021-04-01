<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarIkatanKerjaModel extends Model
{
    protected $table = "daftar_ikatan_kerja";
    protected $primaryKey = "id_ikatan_kerja";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_ikatan_kerja','nama_ikatan_kerja'
    ];
}
