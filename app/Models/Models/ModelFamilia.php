<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFamilia extends Model
{
    protected $table='familias';
    protected $fillable=['numero','responsavel','ubs','local','qtd_membros','telefone'];
}
