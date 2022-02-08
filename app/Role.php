<?php

namespace GeCo;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongToMany('GeCo\User');
    }
}
