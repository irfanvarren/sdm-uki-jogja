<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamaJafaModel extends Model
{
    protected $table = "namajafa";
    protected $primaryKey = "id_jafa";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_jafa','nama_jafa'
    ];
}
