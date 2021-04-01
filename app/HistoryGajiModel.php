<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryGajiModel extends Model
{
    protected $table = "history_gaji";
    protected $primaryKey = "id_history";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
       'id_history','id_user','tanggal','bulan','tahun','NIP','id_item','jumlah'
    ];
}
