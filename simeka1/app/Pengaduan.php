<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    
    public function pemakaian(){
    	return $this->belongsTo('App\Pemakaian', 'id_pemakaian');
    }
}
