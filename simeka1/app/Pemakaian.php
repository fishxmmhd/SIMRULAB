<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    //
    public function pengaduan(){
    	return $this->hasOne('App\Pengaduan', 'id_pemakaian');
    }
}
