<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class KepalaUnitModel extends Authenticatable
{
	  use HasApiTokens, Notifiable; 
    protected $table = "kepala_unit";
    protected $primaryKey = "id_kepala_unit";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_kepala_unit','id_user','nama_unit','username','password','reTypePassword'
    ];
}
