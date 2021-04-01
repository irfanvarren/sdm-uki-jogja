<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GolRuangModel extends Model
{
    protected $table = "gol_ruang";
    protected $primaryKey = "id_golRuang";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_golRuang','tanggal','golongan','ruang','no_sk','file_sk','keterangan'
    ];
}
