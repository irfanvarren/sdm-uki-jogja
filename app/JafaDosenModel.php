<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JafaDosenModel extends Model
{
    protected $table = "jafa_dosen";
    protected $primaryKey = "id_jafaDosen";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_jafaDosen','id_user','tanggal','jafa','no_sk','file_sk','keterangan'
    ];
}
