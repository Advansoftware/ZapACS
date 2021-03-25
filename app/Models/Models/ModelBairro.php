<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBairro extends Model
{
    protected $table='bairros';

    public function relContato(){
        return $this->hasMany('App\Models\Models\ModelContato','id_bairro');
    }
}
