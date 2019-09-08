<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class depositoModel extends Model
{
    //
    protected $table = 'tb_deposito';
    protected $fillable = ['nama', 'telp', 'email', 'domisili', 'confirmed'];
}
