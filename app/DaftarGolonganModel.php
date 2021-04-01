<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarGolonganModel extends Model
{
    protected $table = "daftar_golongan";
    protected $primaryKey = "id_gol";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_gol','nama_gol'
    ];
}
