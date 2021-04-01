<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGajiModel extends Model
{
    protected $table = "item_gaji";
    protected $primaryKey = "id_item";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_item','id_user','kelompok','item'
    ];
}
