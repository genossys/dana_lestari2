<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class kreditModel extends Model
{
    //
    protected $table = 'tb_kredit';
    protected $fillable = ['nama', 'telp', 'email', 'domisili', 'pekerjaan', 'penghasilan', 'jaminan', 'pinjaman', 'confirmed'];
}
