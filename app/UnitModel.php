<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UnitModel extends Model
{
    protected $table = "daftar_unit";
    protected $primaryKey = "id_unit";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_unit','nama_unit'
    ];
}
