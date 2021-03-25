<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelContato extends Model
{
    protected $table='contatos';

    public function relBairro(){
        return $this->hasOne('App\Models\Models\ModelBairro','id', 'id_bairro');
    }
}

