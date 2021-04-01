<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IkatanKerjaModel extends Model
{
    protected $table = "ikatan_kerja";
    protected $primaryKey = "id_ikatan_kerja";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_ikatan_kerja','id_user','tanggal','status','nomor_sk','file_sk'
    ];
    
}
