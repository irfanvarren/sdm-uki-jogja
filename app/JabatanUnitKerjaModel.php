<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanUnitKerjaModel extends Model
{
    protected $table = "jabatan_unit_kerja";
    protected $primaryKey = "id_jabatan_unit_kerja";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_jabatan_unit_kerja','nama_jabatan_unit_kerja'
    ];
}
