<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerjaModel extends Model
{
    protected $table = "unit_kerja";
    protected $primaryKey = "id_unit_kerja";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_unit_kerja','id_user','tanggal','unit_kerja','jabatan','no_sk','file_sk'
    ];
}
