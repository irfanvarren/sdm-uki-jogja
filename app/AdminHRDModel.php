<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class AdminHRDModel extends Authenticatable
{
	  use HasApiTokens, Notifiable; 
    protected $table = "admin";
    protected $primaryKey = "id_admin";
    public $timestamps = false;
    public $incrementing = true;
    public $fillable = [
        'id_admin','admin','username','password','reTypePassword'
    ];
}
